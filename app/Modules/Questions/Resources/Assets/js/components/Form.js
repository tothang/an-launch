import React, {Component} from 'react';
import Select from 'react-select'

export default class Form extends Component {
  render() {
    const {from, question, speakers, handleSubmit, handleInput, handleSpeakerSelect} = this.props

    return (
      <div className="fadeIn">
        <div className="questions__form">
          <div className="form-group">
            <label htmlFor="from">Your Name</label>
            <input
              name="from"
              id="from"
              className="form-control"
              value={from}
              onChange={handleInput}
            />
          </div>

          {speakers.length > 0 &&
            <div className="form-group">
              <label htmlFor="to">Who is your question for?</label>
              <Select options={speakers} onChange={handleSpeakerSelect}/>
            </div>
          }

          <div className="form-group">
            <label htmlFor="question">Your Question</label>
            <input
              name="question"
              id="question"
              className="form-control"
              value={question}
              onChange={handleInput}
            />
          </div>

          <div className="clear"></div>

          <div className="form-group">
            <button className="btn btn-primary" id="question-submit-button" onClick={handleSubmit}>Submit</button>
          </div>
        </div>
      </div>
    )
  }
}
