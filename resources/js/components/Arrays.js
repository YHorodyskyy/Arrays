import React from 'react';
import ReactDOM from 'react-dom';

const e = React.createElement;

function ArrayTable(props) {
    const array = props.numbers;
    return (
        <table className="table text-end">
            <tbody>
            {array.map((row) => (
                <tr key={row}>
                    {row.map((item) => (
                        <td key={item}>{item}</td>
                    ))}
                </tr>
            ))}
            </tbody>
        </table>
    );
}

function ArraysCompare(props) {
    const inputArray = props.inputArray;
    const outputArray = props.outputArray;
    return (
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
    );
}

function LastSortsTable(props) {
    const array = props.records;
    const url = "/api/array/download/:id";
    return (
        <div>
            {array.map((row) => (
                <div className="card mt-3" key={row.id}>
                    <div className="card-header">
                        <h3 className="float-start">{row.sort_type} <small>({(new Date(row.created_at)).toDateString()})</small></h3>
                        <div className="float-end">
                            <a href={url.replace(':id', row.id)} download>
                                <button type="button" className="btn btn-primary">Download</button>
                            </a>
                        </div>
                    </div>
                    <div className="card-body">
                        <ArraysCompare inputArray={JSON.parse(row.input_array)}
                                       outputArray={JSON.parse(row.output_array)}/>
                    </div>
                </div>
            ))}
        </div>
    );
}

function Alert(props) {
    const className = "alert-dismissible fade show alert alert-" + props.level;
    const message = props.message;
    if (message) {
        return (
            <div className={className} role="alert">
                {message}
                <button type="button" className="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
            data: [],
            records: [],
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
        this.loadData(apiRouteSort); // /api/array/write
    };

    writeToDBArray() {
        this.loadData(apiRouteWrite); // /api/array/write
    };

    buildAPIUrl(action) {
        return action + "/?array_size=" + this.state.arraySize + "&array_sort=" + this.state.arraySort
    };

    loadData(action) {
        const url = this.buildAPIUrl(action);
        fetch(url, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
            .then(response => response.json())
            .then(
                (result) => {
                    this.setState({
                        isLoaded: true,
                        records: result.records ?? [],
                        message: result.message,
                        data: result.data ?? []
                    });
                },
                (error) => {
                    this.setState({
                        isLoaded: true,
                        error
                    });
                }
            )
    };

    componentDidMount() {
        this.loadData(apiRouteSort);
    }

    render() {
        const {message, records, data} = this.state;
        const fileDownload = "api/array/download?array_size=" + this.state.arraySize + "&array_sort=" + this.state.arraySort;
        return (
            <div>
                <div className="row g-5">
                    <div className="col-auto">
                        <div className="row">
                            <label htmlFor="arraySize" className="col-sm-7 col-form-label">Size array, <span
                                className="small">2-10</span></label>
                            <div className="col-sm-5">
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
                        <a href={fileDownload} download>
                            <button type="button" className="btn btn-primary">Download</button>
                        </a>
                    </div>
                    <div className="col-auto">
                        <button onClick={this.writeToDBArray} type="button" className="btn btn-primary">Write to DB
                        </button>
                    </div>
                </div>
                <div className="row mt-3 justify-content-center">
                    <Alert level="info" message={message}/>
                </div>
                <div className="row mt-3 justify-content-center">
                    <ArraysCompare inputArray={data.inputArray ?? []} outputArray={data.outputArray ?? []}/>
                </div>
                <div className="row mt-3 justify-content-center">
                    <h2>Last result</h2>
                    <LastSortsTable records={records}/>
                </div>
            </div>
        );
    }
}

if (document.getElementById('app')) {
    ReactDOM.render(React.createElement(MainContainer), document.getElementById('app'));
}
