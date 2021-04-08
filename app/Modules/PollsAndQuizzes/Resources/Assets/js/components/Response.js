import React, {Component} from 'react';

export default class Response extends Component {
    render() {
        const {message} = this.props;

        return (
            <div className='question__response'>
                <h3>{message}</h3>
            </div>
        )
    }
}
