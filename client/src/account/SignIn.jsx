import React, {useEffect} from 'react';
import Avatar from '@material-ui/core/Avatar';
import Button from '@material-ui/core/Button';
import CssBaseline from '@material-ui/core/CssBaseline';
import TextField from '@material-ui/core/TextField';
import FormControlLabel from '@material-ui/core/FormControlLabel';
import Checkbox from '@material-ui/core/Checkbox';
import Link from '@material-ui/core/Link';
import Grid from '@material-ui/core/Grid';
import Box from '@material-ui/core/Box';
import LockOutlinedIcon from '@material-ui/icons/LockOutlined';
import Typography from '@material-ui/core/Typography';
import { makeStyles } from '@material-ui/core/styles';
import Container from '@material-ui/core/Container';
import Copyright from "./Copyright";
import * as Yup from 'yup';
import {login, logout} from '../actions/user.actions';
import { useDispatch, useSelector} from "react-redux";
import { useForm, FormProvider } from "react-hook-form";
import FormTextInput from "../components/FormTextInput";
import {useHistory} from "react-router-dom";
import {LoggedOutNavbar} from "./LoggedOutNavbar";

const useStyles = makeStyles((theme) => ({
    paper: {
        marginTop: theme.spacing(8),
        display: 'flex',
        flexDirection: 'column',
        alignItems: 'center',
    },
    avatar: {
        margin: theme.spacing(1),
        backgroundColor: theme.palette.secondary.main,
    },
    form: {
        width: '100%', // Fix IE 11 issue.
        marginTop: theme.spacing(1),
    },
    submit: {
        margin: theme.spacing(3, 0, 2),
    },
}));

export const SignIn = () => {
    const history = useHistory();
    const signingIn = useSelector(state => state.user.isSigningIn);
    const dispatch = useDispatch();
    const methods = useForm();
    const { handleSubmit } = methods;

    useEffect(() => {
        dispatch(logout())
    }, []);

    const classes = useStyles();

    const submitHandler = (data, e) => {
        const from  = window.location.state || "/";
        dispatch(login(data.email, data.password, from));
        history.push(from);
    }

    const validationSchema = Yup.object().shape({
        username: Yup.string().email('Niepoprawny email').required('Podaj adres email'),
        password: Yup.string().required('Podaj hasło').min(8, 'Hasło powinno mieć co najmniej 8 znaków.')
    });

    return (
        <div>
            <LoggedOutNavbar/>
            <Container component="main" maxWidth="xs">
                <CssBaseline />
                <div className={classes.paper}>
                    <Avatar className={classes.avatar}>
                        <LockOutlinedIcon />
                    </Avatar>
                    <Typography component="h1" variant="h5">
                        Zaloguj się
                    </Typography>
                    <FormProvider {...methods} >
                        <form className={classes.form} onSubmit={handleSubmit(submitHandler)} >
                            <FormTextInput
                                name="email"
                                label="Adres e-mail"
                                required
                                variant="outlined"
                                margin="normal"
                                fullWidth
                                autoComplete="email"
                            />
                            <FormTextInput
                                name="password"
                                type="password"
                                label="Hasło"
                                required
                                variant="outlined"
                                margin="normal"
                                fullWidth
                                autoComplete="password"
                            />
                            <FormControlLabel
                                control={<Checkbox value="remember" color="primary" />}
                                label="Zapamiętaj"
                            />
                            <Button
                                type="submit"
                                fullWidth
                                variant="contained"
                                color="primary">
                                Zaloguj
                            </Button>
                            <Grid container>
                                <Grid item xs>
                                    <Link href="#" variant="body2">
                                        Przypomnij mi hasło
                                    </Link>
                                </Grid>
                                <Grid item>
                                    <Link href="/signup" variant="body2">
                                        {"Nie masz jeszcze konta? Zapisz się"}
                                    </Link>
                                </Grid>
                            </Grid>
                        </form>
                    </FormProvider>
                </div>
                <Box mt={8}>
                    <Copyright />
                </Box>
            </Container>
        </div>
    );
}

export default SignIn;
