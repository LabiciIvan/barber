import { configureStore } from "@reduxjs/toolkit";
import authReducer from './authSlice';
import shopReducer from './shopSlice';
import counterReducer from './counterSlice';

export const store = configureStore({
  reducer: {
    auth: authReducer,
    shop: shopReducer,
    counter: counterReducer
  },
});