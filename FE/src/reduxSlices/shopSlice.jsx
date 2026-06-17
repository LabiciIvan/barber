import { createSlice } from "@reduxjs/toolkit";

const initialState = {
    shops: null,
}

const shopSlice = createSlice({
    name: 'shop',
    initialState,
    reducers: {
        setShops: (state, action) => {
            state.shops = action.payload;
        }
    }
});

// Export selectors
export const selectorShops = (state) => state.shop.shops;

// Export actions
export const {setShops} = shopSlice.actions;


// Default named exporter
export default shopSlice.reducer;