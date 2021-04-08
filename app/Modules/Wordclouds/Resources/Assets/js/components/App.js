import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios'
import Holding from "./Holding";
import Form from "./Form";

export default class App extends Component {
    constructor(props) {
        super(props);

        this.state = {
            wordcloud: {},
            word: '',
            isSubmitting: false
        }

        this.handleSubmit = this.handleSubmit.bind(this);
        this.handleInput = this.handleInput.bind(this);
    }

    componentDidMount() {
        let data = {
            'api_token': window.Laravel.apiToken,
            'user_id': window.Laravel.userId
        };

        axios.post('/api/wordclouds', data).then(response => {
            this.setState({ wordcloud: response.data })
        });

        Echo.channel('wordclouds.' + this.props.streamId)
            .listen('.TriggerWordcloud', (response) => {
                this.setState({ wordcloud: response.wordcloud })
            })
    }

    handleInput (e) {
        this.setState({ 'word': e.target.value })
    }

    handleSubmit() {
        const {wordcloud, word} = this.state
        const data = {
            'user_id': window.Laravel.userId,
            'word': word,
        }

        this.setState({ isSubmitting: true });

        axios.post(`/api/wordclouds/${wordcloud.id}`, data)
            .then(response => {
                this.setState({
                    word: '',
                    wordcloud: response.data,
                });
            }).finally(() => {
                setTimeout( () => {
                    this.setState({isSubmitting: false})
                }, 2000);
            });
    }

    render() {
        const {wordcloud, word, isSubmitting} = this.state
        const {handleSubmit, handleInput} = this

        return (
            <div className="question__container">
                { isSubmitting &&
                    <div className='text-center'>
                        Submitting
                    </div>
                }

                { isSubmitting === false && wordcloud.active === "0" &&
                    <Holding
                        message={wordcloud.holding_message}
                    />
                }

                { isSubmitting === false && wordcloud.active === "1" &&
                    <Form
                        wordcloud={wordcloud}
                        word={word}
                        handleInput={handleInput}
                        handleSubmit={handleSubmit}
                    />
                }
            </div>
        );
    }
}

if (document.getElementById('wordcloud-container')) {
    const element = document.getElementById('wordcloud-container')
    const props = Object.assign({}, element.dataset)
    ReactDOM.render(<App {...props}/>, element)
}
