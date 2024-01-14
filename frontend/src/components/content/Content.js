import React from "react";
import classNames from "classnames";
import { Container } from "react-bootstrap";

class Content extends React.Component {
  render() {
    return (
      <Container
        fluid
        className={classNames("content", { "is-open": this.props.isOpen })}
      >

      </Container>
    );
  }
}

export default Content;