import React from "react";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import {
  faHome,
  faList,
  faTimes,
  faTrophy,
  faPeopleGroup
} from "@fortawesome/free-solid-svg-icons";
import { Nav, Button } from "react-bootstrap";
import classNames from "classnames";

class SideBar extends React.Component {
  render() {
    return (
      <div className={classNames("sidebar", { "is-open": this.props.isOpen })}>
        <div className="sidebar-header">
          <Button
            variant="link"
            onClick={this.props.toggle}
            style={{ color: "#fff" }}
            className="mt-4"
          >
            <FontAwesomeIcon icon={faTimes} pull="right" size="xs" />
          </Button>
          <h3>react-bootstrap sidebar</h3>
        </div>

        <Nav className="flex-column pt-2">
          <p className="ml-3">Heading</p>

          <Nav.Item className="active">
            <Nav.Link href="/">
              <FontAwesomeIcon icon={faHome} className="mr-2" />
              Home
            </Nav.Link>
          </Nav.Item>

          <Nav.Item>
            <Nav.Link href="/campeonato">
              <FontAwesomeIcon icon={faTrophy} className="mr-2" />
              Campeonato
            </Nav.Link>
          </Nav.Item>

          <Nav.Item>
            <Nav.Link href="/historico">
              <FontAwesomeIcon icon={faList} className="mr-2" />
              Histórico
            </Nav.Link>
          </Nav.Item>

          <Nav.Item>
            <Nav.Link href="/times">
              <FontAwesomeIcon icon={faPeopleGroup} className="mr-2" />
              Time
            </Nav.Link>
          </Nav.Item>
        </Nav>
      </div>
    );
  }
}

export default SideBar;