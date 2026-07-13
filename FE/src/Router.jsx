import { createBrowserRouter, RouterProvider } from "react-router-dom";
import PublicRoute from "./components/PublicRoute";
import RootLayout from "./components/RootLayout";
import Login from "./components/Login";
import ProtectedRoute from "./components/ProtectedRoute";
import Shop from "./pages/shop";
import Booking from "./pages/booking";
import Home from "./pages/home";

const router = createBrowserRouter([
  {
    path: "/",
    element: <RootLayout />,
    children: [
      {
        path: "login",
        element: <PublicRoute> <Login /> </PublicRoute>
      },
      {
        path: "home",
        element: <ProtectedRoute><Home /></ProtectedRoute>,
      },
      {
        path: "shops/:id",
        element: <ProtectedRoute><Shop /></ProtectedRoute>,
      },
      {
        path: "booking/shop/:shopId/service/:serviceId",
        element: <ProtectedRoute><Booking /></ProtectedRoute>
      }
    ],
  },
]);

<RouterProvider router={router} />

export default router;