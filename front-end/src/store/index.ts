// ** Toolkit imports
import { configureStore } from '@reduxjs/toolkit'

// ** Reducers
import login from './apps/login/index'
import doctor from './apps/doctor/index'
import treatment from './apps/treatment/index'
import clinic from './apps/clinic/index'
import appointment from './apps/appointment/index'

export const store = configureStore({
    reducer: {
        login,
        doctor,
        treatment,
        clinic,
        appointment
    },
    middleware: getDefaultMiddleware =>
        getDefaultMiddleware({
            serializableCheck: false
        })
})

export type AppDispatch = typeof store.dispatch
export type RootState = ReturnType<typeof store.getState>
