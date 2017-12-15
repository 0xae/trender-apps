import * as React from 'react';

export function Welcome(props: any) {
    return (
        <p>
        Hello {props.name}
        </p>
    );
}

export class MyComp extends React.Component {
    render() {
        return (
            <h1>hello there</h1>
        );
    }
}

export default Welcome;
