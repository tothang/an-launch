import React, {Component} from 'react';

export default class Form extends Component {
    render() {
        const {wordcloud, word, handleSubmit, handleInput} = this.props

        return (
            <div className="fadeIn">
                <h3 className="question__question">{wordcloud.question}</h3>

                <div className="form-group">
                    <label htmlFor="word">
                        Enter your word
                        <small> (Maximum <span className="jq-statement-character-limit">{wordcloud.character_limit}</span> Characters)</small>
                    </label>
                    <input name="word" id="word" className="form-control" placeholder="Type Here..."
                           maxLength={wordcloud.character_limit} required value={word} onChange={handleInput}>
                    </input>
                </div>

                <div className="clear"></div>

                <div className="form-group">
                    <button className="btn btn-primary" id="wordcloud-submit-button" onClick={handleSubmit}>Submit</button>
                </div>
            </div>
        )
    }
}
