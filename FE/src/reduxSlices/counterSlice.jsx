import { createSlice } from "@reduxjs/toolkit";


const counterSlice = createSlice({
    name: "counter",
    initialState: {
        number: 0,
        isPositive: false,
        isNegative: false,
        isNull: true
    },
    reducers: {
        incrementNumber: (state, action) => {

            console.log('----increment Number---->');
            console.log('----type---->', action.type);
            console.log('----payload---->', action.payload);
            console.log('----increment Number---->');
            state.number += action.payload;

            if (state.number > 0) {
                state.isPositive = true;
                state.isNegative = false;
                state.isNull = false;
            }

            if (state.number === 0) {
                state.isPositive = false;
                state.isNegative = false;
                state.isNull = true;
            }
        },
        decrementNumber: (state, action) => {
            console.log('----decrement Number---->');
            console.log('----type---->', action.type);
            console.log('----payload---->', action.payload);
            console.log('----decrement Number---->');

            state.number -= action.payload;

            if (state.number < 0) {
                state.isPositive = false;
                state.isNegative = true;
                state.isNull = false;
            }

            if (state.number === 0) {
                state.isPositive = false;
                state.isNegative = false;
                state.isNull = true;
            }
        }
    }
});

export const numberSelector = (state) => state.counter.number;
export const positiveSelector = (state) => state.counter.isPositive;
export const negativeSelector = (state) => state.counter.isNegative;
export const nullSelector = (state) => state.counter.isNull;

export const {incrementNumber, decrementNumber} = counterSlice.actions;

export default counterSlice.reducer;