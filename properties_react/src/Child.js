import React from 'react';
import PropTypes from 'prop-types';

class Child extends React.Component {
    render() {
        return (
            <div>
                <h2>Child Component</h2>
                <p>Name: {this.props.name}</p>
                <p>Age: {this.props.age}</p>
            </div>
        );
    }
}

Child.propTypes = {
    name: PropTypes.string.isRequired,
    age: PropTypes.number.isRequired
};

export default Child;