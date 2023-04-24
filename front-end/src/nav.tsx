import React from "react";
import {useSelector} from "react-redux";
import {RootState} from "./store";
import {Link} from "react-router-dom";

function Nav() {
    const isLogin: boolean = useSelector((state: RootState) => state.login.isLogin)

    return (
        <>
            {isLogin && (
                <div className="nav">
                    <Link to="/doctor">Doktor</Link>
                    <Link to="/clinic">Klinik</Link>
                    <Link to="/treatment">Tedavi</Link>
                    <Link to="/appointment">Randevu</Link>
                </div>
            )}
        </>
    );
}

export default Nav;
