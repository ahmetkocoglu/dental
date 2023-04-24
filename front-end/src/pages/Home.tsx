import {AppDispatch, RootState} from "../store";
import {useDispatch, useSelector} from "react-redux";
import {useEffect, useState} from "react";
import { Routes, Route } from 'react-router-dom';
import {login} from "../store/apps/login";
import "../style/styles.css";
import Doctor from "./Doctor";
import Treatment from "./Treatment";

function Home() {
    // ** Redux
    const dispatch = useDispatch<AppDispatch>()

    // ** Selector
    const isLoginLoading: string = useSelector((state: RootState) => state.login.isLoginLoading)
    const loginErrorMessage: string = useSelector((state: RootState) => state.login.loginErrorMessage)

    useEffect(() => {
        if (isLoginLoading === 'succeeded')
            setIsSubmitted(true);
        if (isLoginLoading === 'failed') {
            setErrorMessages({name: "error", message: loginErrorMessage});
            setIsSubmitted(false);
        }

    }, [isLoginLoading, loginErrorMessage])

    // React States
    const [errorMessages, setErrorMessages] = useState({name: "", message: ""});
    const [isSubmitted, setIsSubmitted] = useState(false);

    const handleSubmit = (event: any) => {
        event.preventDefault();

        const {email, password} = document.forms[0];

        dispatch(login({email: email.value, password: password.value}))
    };

    const renderErrorMessage = (name: string) =>
        name === errorMessages.name && (
            <div className="error">{errorMessages.message}</div>
        );

    const renderForm = (
        <div className="form">
            <form onSubmit={handleSubmit}>
                <div className="input-container">
                    <label>E-Posta</label>
                    <input type="email" name="email" required/>
                </div>
                <div className="input-container">
                    <label>Şifre</label>
                    <input type="password" name="password" required/>
                </div>
                <hr/>
                {renderErrorMessage("error")}
                <div className="button-container">
                    {isLoginLoading === 'pending' ? <div>giriş yapılıyor...</div> : <input type="submit"/>}
                </div>
            </form>
        </div>
    );

    return (
        <div className="app">
            {isSubmitted ? (
                <>
                    <div className="success-message title">Giriş Başarılı</div>
                </>
            ) : (
                <>
                    <div className="login-form">
                        <div className="title">Kullanıcı Girişi</div>
                        {renderForm}
                    </div>
                </>
            )}
        </div>
    );
}

export default Home
