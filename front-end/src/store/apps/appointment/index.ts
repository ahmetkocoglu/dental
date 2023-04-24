// ** Redux Imports
import {createSlice, createAsyncThunk} from '@reduxjs/toolkit'

// ** Axios Imports
import axios from 'axios'

// ** Config
import authConfig from '../../../service/config'

// ** fetch
export const fetchAppointmentData = createAsyncThunk('getAppointments/fetchAppointmentData', async () => {
    const response = await axios.get(authConfig.appointment)

    return response.data
})

// ** post
export const setAppointment = createAsyncThunk('setAppointments/fetchAppointmentData', async (payload: any) => {
    const response = await axios.post(authConfig.appointment, payload)

    return response.data
})

// ** put
export const updateAppointment = createAsyncThunk('updateAppointments/fetchAppointmentData', async (payload: any) => {
    const response = await axios.put(authConfig.appointment + '/' + payload.id, {treatments: payload.treatment})

    return response.data
})

// ** delete
export const deleteAppointment = createAsyncThunk('deleteAppointments/fetchAppointmentData', async (id: number) => {
    const response = await axios.delete(authConfig.appointment + '/' + id)

    return response.data
})

export const appAppointmentSlice = createSlice({
    name: 'appAppointments',
    initialState: {
        data: [],
        isLoading: 'idle',
        isSave: 'idle'
    },
    reducers: {},
    extraReducers: builder => {
        builder.addCase(fetchAppointmentData.pending, (state) => {
            state.isLoading = 'pending'
        })
        builder.addCase(fetchAppointmentData.fulfilled, (state, action) => {
            if (action.payload.status) {
                state.isLoading = 'succeeded'
                state.data = action.payload.data
            } else {
                state.isLoading = 'failed'
            }
        })
        builder.addCase(fetchAppointmentData.rejected, (state) => {
            state.isSave = 'failed'
        })

        builder.addCase(setAppointment.pending, (state) => {
            state.isSave = 'pending'
        })
        builder.addCase(setAppointment.fulfilled, (state, action) => {
            if (action.payload.status) {
                state.isSave = 'succeeded'
            } else {
                state.isSave = 'failed'
            }
        })
        builder.addCase(setAppointment.rejected, (state) => {
            state.isSave = 'failed'
        })

        builder.addCase(deleteAppointment.pending, (state) => {
            state.isSave = 'pending'
        })
        builder.addCase(deleteAppointment.fulfilled, (state, action) => {
            if (action.payload.status) {
                state.isSave = 'succeeded'
            } else {
                state.isSave = 'failed'
            }
        })
        builder.addCase(deleteAppointment.rejected, (state) => {
            state.isSave = 'failed'
        })

        builder.addCase(updateAppointment.pending, (state) => {
            state.isSave = 'pending'
        })
        builder.addCase(updateAppointment.fulfilled, (state, action) => {
            if (action.payload.status) {
                state.isSave = 'succeeded'
            } else {
                state.isSave = 'failed'
            }
        })
        builder.addCase(updateAppointment.rejected, (state) => {
            state.isSave = 'failed'
        })
    }
})

export default appAppointmentSlice.reducer
