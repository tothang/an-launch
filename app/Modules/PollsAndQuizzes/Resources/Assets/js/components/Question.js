import React, {Component} from 'react';

export default class Question extends Component {
    render() {
        const {question, answers, handleClick, handleSubmit, activeStatus} = this.props

        return (
            <div className="fadeIn">
                <h3 className="question__title">{question}</h3>
                <div className="question__answers">
                    {answers.map(function (answer, key) {
                        return (
                            <div key={key} className={"question__button btn btn-default btn-block " + activeStatus(answer.id)}
                                 onClick={event => handleClick(answer.id)}>
                                {answer.value}
                            </div>)
                    })}
                    <button className="question__button btn btn-primary" onClick={handleSubmit}>Submit</button>
                </div>
            </div>
        )
    }
}
