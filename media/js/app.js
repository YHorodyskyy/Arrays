const e = React.createElement;

function ArrayTable(props) {
    const array = props.numbers;
    return (
        <table className="table text-end">
            <tbody>
            {array.map((row) => (
                <tr>
                    {row.map((item) => (
                        <td>{item}</td>
                    ))}
                </tr>
            ))}
            </tbody>
        </table>
    );
}

function Alert(props) {
    const className = "alert alert-" + props.level;
    const message = props.message;
    if (message) {
        return (
            <div className={className} role="alert">
                {message}
            </div>
        );
    } else {
       return (<div/>);
    }
}

class MainContainer extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            error: null,
            isLoaded: false,
            message: null,
            inputArray: [],
            outputArray: [],
            arraySize: 3,
            arraySort: "Vertical"
        };
        this.writeToDBArray = this.writeToDBArray.bind(this);
        this.printArray = this.printArray.bind(this);
        this.setArraySize = this.setArraySize.bind(this);
        this.setArraySort = this.setArraySort.bind(this);
    }

    setArraySize(event) {
        this.setState({arraySize: event.target.value});
    }

    setArraySort(event) {
        this.setState({arraySort: event.target.value});
    }

    printArray() {
        this.componentDidMount("get_html");
    };

    writeToDBArray() {
        this.componentDidMount("write_to_db");
    };

    componentDidMount(action) {
        fetch("?action=" + action + "&array_size=" + this.state.arraySize + "&array_sort=" + this.state.arraySort)
            .then(res => res.json())
            .then(
                (result) => {
                    this.setState({
                        isLoaded: true,
                        message: result.message,
                        inputArray: result.data.inputArray,
                        outputArray: result.data.outputArray
                    });
                },
                (error) => {
                    this.setState({
                        isLoaded: true,
                        error
                    });
                }
            )
    }

    render() {
        const {message, inputArray, outputArray} = this.state;
        const fileDownload = "?action=get_file&array_size=" + this.state.arraySize + "&array_sort=" + this.state.arraySort;
        return (
            <div>
                <div className="row g-5">
                    <div className="col-auto">
                        <div className="row">
                            <label htmlFor="arraySize" className="col-sm-8 col-form-label">Size array, <span
                                className="small">2-10</span></label>
                            <div className="col-sm-4">
                                <input type="number" min="2" max="10" step="1" className="form-control"
                                       name="array_size" id="arraySize"
                                       value={this.state.arraySize} onChange={this.setArraySize}
                                />
                            </div>
                        </div>
                    </div>
                    <div className="col-auto">
                        <select value={this.state.arraySort} onChange={this.setArraySort} name="sort_type"
                                className="form-select">
                            <option value="Vertical">Vertical</option>
                            <option value="Horizontal">Horizontal</option>
                            <option value="Diagonal">Diagonal</option>
                            <option value="Snake">Snake</option>
                            <option value="Snail">Snail</option>
                        </select>
                    </div>
                    <div id="sort_button" className="col-auto">
                        <button onClick={this.printArray} type="button" className="btn btn-primary">Sort</button>
                    </div>
                    <div className="col-auto">
                        <a
                            href={fileDownload}
                            download
                        >
                            <button type="button" className="btn btn-primary">Download</button>
                        </a>
                    </div>
                    <div className="col-auto">
                        <button onClick={this.writeToDBArray} type="button" className="btn btn-primary">Write to DB
                        </button>
                    </div>
                </div>
                <div className="row mt-3 justify-content-center">
                    <Alert level="info" message={message} />
                </div>
                <div className="row mt-3 justify-content-center">
                    <div className="col-auto">
                        <h2>Input Array</h2>
                        <ArrayTable numbers={inputArray}/>
                    </div>
                    <div className="col-auto">
                        <h2>Output Array</h2>
                        <ArrayTable numbers={outputArray}/>
                    </div>
                </div>
            </div>
        );
    }
}

ReactDOM.render(
    e(MainContainer),
    document.getElementById('app')
);
