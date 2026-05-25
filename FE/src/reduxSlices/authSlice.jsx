import { createSlice } from "@reduxjs/toolkit";

const initialState = {
  isAuthenticated: false,
  isLoading: false,
  bearerToken: null,
  user: null,
};

const authSlice = createSlice({
  name: "auth",
  initialState,
  reducers: {
    login: (state, action) => {
      state.isAuthenticated = true;
      state.bearerToken = action.payload;
    },
    logout: (state, action) => {
      state.isAuthenticated = false;
      state.bearerToken = null;
      state.user = null;
    },
    setLoading: (state, action) => {
      state.isLoading = action.payload;
    },
    setUser: (state, action) => {
      state.user = action.payload;
    }
  },
});

// Redux Selectors -> used in components to show the state.
export const selectIsAuthenticated = (state) => state.auth.isAuthenticated;
export const selectIsLoading = (state) => state.auth.isLoading;
export const selectUsers = (state) => state.auth.user;
export const selectBearerToken = (state) => state.auth.bearerToken;

// Redux Actions -> used in components to modify the state.
export const { login, logout, setLoading, setUser } = authSlice.actions;

// Redux Reducer -> used in store to configure state.
export default authSlice.reducer;