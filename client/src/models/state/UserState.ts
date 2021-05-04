export interface UserState {
    isUserLoggedIn: boolean
    userData: LoggedInUserData | null
}

interface LoggedInUserData {
    userId: number,
    token: string
}
