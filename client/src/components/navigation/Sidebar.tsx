import React from 'react';

type SidebarState = {
    collapsed: boolean
}

export class SideBar extends React.Component<{}, SidebarState> {
    state: SidebarState = {
        collapsed: false
    }

    toggle = () => {
        this.setState({
            collapsed: !this.state.collapsed
        });
    }

    onCollapse = (collapsed: boolean) => {
        console.log(collapsed);
        this.setState({ collapsed: collapsed });
      };

    render() {
        return(
            <p>Sidebar</p>
        );
    }
}

