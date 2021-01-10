import React from 'react';

const Column = (props: {isOver: boolean, children: any}): JSX.Element => {
    const {isOver, children} = props;
    const className = isOver ? 'highlight-region' : '';
    return (
        <div className={`col${className}`}>
            {children}
        </div>
    );
}
