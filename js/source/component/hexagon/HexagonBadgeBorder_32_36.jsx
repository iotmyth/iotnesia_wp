const React = require('react');

const plugins = require('../../utils/plugins');

class HexagonBadgeBorder_32_36 extends React.Component {
  constructor(props) {
    super(props);
    this.hexagonRef = React.createRef();
  }

  componentDidMount() {
    plugins.createHexagon({
      containerElement: this.hexagonRef.current,
      width: 32,
      height: 36,
      roundedCorners: true,
      roundedCornerRadius: 1,
      fill: true,
      lineColor: vikinger_constants.colors['--color-box-background']
    });
  }

  render() {
    return (
      <div className="user-avatar-badge-border">
        <div ref={this.hexagonRef} className="hexagon-32-36"></div>
      </div>
    );
  }
}

module.exports = HexagonBadgeBorder_32_36;