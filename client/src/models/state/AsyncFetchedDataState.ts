export interface AsyncFetchedDataState<T> {
    loading: boolean,
    data: Array<T>,
    error: string
}
