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

export const { login, logout, setLoading, setUser } = authSlice.actions;
export default authSlice.reducer;