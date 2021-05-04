import {AnyAction} from "redux";
import {UserState} from "../../models/state/UserState";

const initialUserState: UserState = {
    isUserLoggedIn: false,
    userData: null
}

export const user = (prevState: any = initialUserState, action: AnyAction)  => {
    switch (action.type) {
        default:
            return prevState;
    }
}
