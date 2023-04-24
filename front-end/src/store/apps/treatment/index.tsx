// ** Redux Imports
import { createSlice, createAsyncThunk } from '@reduxjs/toolkit'

// ** Axios Imports
import axios from 'axios'

// ** Config
import authConfig from '../../../service/config'
import {fetchAppointmentData} from "../appointment";

// ** fetch
export const fetchTreatmentData = createAsyncThunk('getTreatments/fetchTreatmentData', async () => {
    const response = await axios.get(authConfig.treatment)

    return response.data
})

export const appTreatmentSlice = createSlice({
    name: 'appTreatments',
    initialState: {
        data: [],
        isLoading: 'idle'
    },
    reducers: {},
    extraReducers: builder => {
        builder.addCase(fetchTreatmentData.pending, (state) => {
            state.isLoading = 'pending'
        })
        builder.addCase(fetchTreatmentData.fulfilled, (state, action) => {
            if (action.payload.status){
                state.isLoading = 'succeeded'
                state.data = action.payload.data
            } else {
                state.isLoading = 'failed'
            }
        })
        builder.addCase(fetchTreatmentData.rejected, (state) => {
            state.isLoading = 'failed'
        })
    }
})

export default appTreatmentSlice.reducer
