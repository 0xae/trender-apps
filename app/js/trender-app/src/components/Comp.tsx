import * as React from 'react';
class Person {
    name: string;
    age: number;

    constructor(name: string, age: number) {
        this.name = name;
        this.age = age;
    }
}

let obj: Person = {
    name: 'Ayrton Gomes',
    age: 16
};

function format(a: Person) {
    return a.name;
}

class Comp extends React.Component {
    render() {
        return  (
            <div className="element">
                <h1>{format(obj)}</h1>
                <small>{obj.age}</small>
            </div>
        );
    }
}

export default Comp;