import * as React from 'react';

interface State {
    name: string
}

class Welcome extends React.Component<State, State> {
    constructor(props: State) {
        super(props);
        this.state = {name: props.name};
    }

    render() {
        return (
            <div>
                <h2>hello there {this.state.name}</h2>
                <button onClick={this.requestName}>
                    Request your name
                </button>
            </div>
        );
    }

    requestName = () => {
        let n:any = prompt("Your name");
        this.setState({
            name: n
        });
    }
}

export default Welcome;
