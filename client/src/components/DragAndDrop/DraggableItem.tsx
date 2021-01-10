import React, {Fragment, useState, useRef } from 'react';
import { useDrag, useDrop } from 'react-dnd';
import { ITEM_TYPE } from './data/types';
import { DragObjectWithType } from "react-dnd";

interface DraggableType extends DragObjectWithType  {
    index: number
}

export const DraggableItem = (props: {item: DraggableType, index: any, moveItem: any, status: any}) => {
    const {item, index, moveItem, status } = props;
    const ref = useRef(null);

    const [, drop] = useDrop({
        accept: ITEM_TYPE,
        hover(item: DraggableType, monitor) {
            if(!ref.current) {
                return;
            }

            const dragIndex = item.index;
            const hoverIndex = index;

            if(dragIndex == hoverIndex) {
                return;
            }
            /*
            const hoverRect = ref.current.getBoundClientRect();
            const hoverMiddleY = (hoverRect.bottom - hoverRect.top) / 2;
            const mousePosition = monitor.getClientOffset();
            const hoverClientY = mousePosition.y - hoverRect.top;
            */

        }
    });
}
