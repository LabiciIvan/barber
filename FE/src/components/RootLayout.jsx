import { Outlet } from "react-router-dom";
import Navbar from "./NavBar";

function RootLayout() {
  return (
    <div>
      <Navbar />
      <Outlet />
    </div>
  );
}

export default RootLayout;