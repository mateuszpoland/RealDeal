export interface UserState {
    isUserLoggedIn: boolean
    userData: LoggedInUserData | null
}

interface LoggedInUserData {
    userId: number,
    //userRealm: string, : reprezentacja tenanta
    userName: string,
    token: string
}
