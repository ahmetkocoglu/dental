import {AppDispatch, RootState} from "./store";
import {useDispatch, useSelector} from "react-redux";
import {useEffect, useState} from "react";
import {login} from "./store/apps/login";
import "./styles.css";

function Home() {
    // ** Redux
    const dispatch = useDispatch<AppDispatch>()

    // ** Selector
    const isLoginLoading = useSelector((state: RootState) => state.login.isLoginLoading)
    const loginErrorMessage = useSelector((state: RootState) => state.login.loginErrorMessage)

    useEffect(() => {
        if (isLoginLoading === 'succeeded')
            setIsSubmitted(true);
        if (isLoginLoading === 'failed') {
            setErrorMessages({name: "error", message: loginErrorMessage});
            setIsSubmitted(false);
        }

    }, [isLoginLoading])

    // React States
    const [errorMessages, setErrorMessages] = useState({name: "", message: ""});
    const [isSubmitted, setIsSubmitted] = useState(false);

    // User Login info
    const database = [
        {
            username: "user1",
            password: "pass1"
        },
        {
            username: "user2",
            password: "pass2"
        }
    ];

    const errors = {
        email: "invalid username",
        password: "invalid password"
    };

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
            <div className="login-form">
                <div className="title">Kullanıcı Girişi</div>
                {isSubmitted ? <div className="title">Giriş Başarılı</div> : renderForm}
            </div>
        </div>
    );
}

export default Home
