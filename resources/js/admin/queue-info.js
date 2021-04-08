import React, {useState, useEffect} from 'react';
import ReactDOM from 'react-dom';
import axios from "axios";
import throttle from 'lodash.throttle';

if (document.getElementById('queue-info-container')) {
    const queue = document.getElementById('queue-info-container').dataset.queue
}

const QueueInfo = () => {
    const [current, setCurrent] = useState(0)
    const [total, setTotal] = useState(0)
    const [cleared, setCleared] = useState(false)

    useEffect(() => {
        axios.get(`queue-info/${queue}`)
            .then((res) => {
                setTotal(res.data.onQueue)
                setCurrent(res.data.onQueue)
            })
    }, [])

    function updateQueue() {
        axios.get(`queue-info/${queue}`)
        .then((res) => {
            setCurrent(res.data.onQueue)
        })
    }

    function clearQueue() {
        axios.get(`queue-clear/${queue}`)
        .then(() => {
            document.getElementById('queue-progress-bar').classList.add('bg-danger', 'w-100')
            setCleared(true)

            setTimeout(function () {
                setCurrent(0)
            }, 2000)
        })
    }

    if (current === 0) {
        return null;
    }

    return (
        <div className="alert alert-primary" role="alert">
            <div className="progress">
                <div
                     id="queue-progress-bar"
                     className="progress-bar progress-bar-striped progress-bar-animated"
                     role="progressbar"
                     style={{ width: 100 - (current/total * 100) + '%' }}>
                </div>
            </div>
            <div className="mt-2">
                { cleared === false ?
                    <div>
                        <span><b>Sending: {total - current + 1}/{total}</b></span>
                        <button onClick={throttle(updateQueue, 1000)} className="ml-2 btn btn-sm btn-primary">Update</button>
                        <button onClick={clearQueue} className="float-right btn btn-sm btn-danger">Clear queue</button>
                    </div>
                    :
                    <div className="text-center text-danger"><span><b>QUEUE CLEARED</b></span></div>
                }
            </div>
        </div>
    )
}

if (document.getElementById('queue-info-container')) {
    ReactDOM.render(<QueueInfo/>, document.getElementById('queue-info-container'));
}
