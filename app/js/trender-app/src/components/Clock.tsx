import * as React from 'react';
import * as ReactDOM from 'react-dom';

function tick() {
    let template = (
        <div>
            <p>{new Date().toLocaleTimeString()}</p>
        </div>
    );

    ReactDOM.render(
        template,
        document.getElementById('clock')
    );
}

export default tick;