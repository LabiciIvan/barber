import { createBrowserRouter, RouterProvider } from "react-router-dom";
import PublicRoute from "./components/PublicRoute";
import RootLayout from "./components/RootLayout";
import Login from "./components/Login";
import ProtectedRoute from "./components/ProtectedRoute";
import App from "./App";

const router = createBrowserRouter([
  {
    path: "/",
    element: <RootLayout />,
    children: [
      { path: "login", element: <PublicRoute> <Login /> </PublicRoute> },
      {
        path: "app",
        element: <ProtectedRoute><App /></ProtectedRoute>,
      },
    ],
  },
]);

<RouterProvider router={router} />

export default router;