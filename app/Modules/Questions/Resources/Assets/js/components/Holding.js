import React, {Component} from 'react';
import ReactDOM from 'react-dom';

export default class Holding extends Component {
    render() {
        const {message} = this.props;

        return (
            <div className='fadeIn'>
                <div className='text-center mt-3'>
                    <h3>{message}</h3>
                </div>
            </div>
        )
    }
}
