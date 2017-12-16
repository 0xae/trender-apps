import * as React from 'react';

interface State {
    date: Date;
}

class Clock extends React.Component<{}, State> {
    timerId: any;

    constructor(props: {}) {
        super(props);
        this.state = {date: new Date()};
    }

    componentDidMount() {
        this.timerId = setInterval(
            () => this.tick(),
            1000
        );
    }

    componentWillUnmount() {
        clearInterval(this.timerId);
    }

    tick() {
        this.setState({
           date: new Date() 
        });
    }

    render() {
        return (
            <div>
                <p>{this.state.date.toLocaleTimeString()}</p>
            </div>
        );
    }
}

export default Clock;