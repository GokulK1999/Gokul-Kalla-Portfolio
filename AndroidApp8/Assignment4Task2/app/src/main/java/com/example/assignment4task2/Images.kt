package com.example.assignment4task2

import android.os.Parcel
import android.os.Parcelable

data class Images(val urlthumbnails:String, val urlimages:String, val
nameimg:String, val type:String) : Parcelable {
    constructor(parcel: Parcel) : this(
        parcel.readString()!!,
        parcel.readString()!!,
        parcel.readString()!!,
        parcel.readString()!!) {
    }

    override fun writeToParcel(parcel: Parcel, flags: Int) {
        parcel.writeString(urlthumbnails)
        parcel.writeString(urlimages)
        parcel.writeString(nameimg)
        parcel.writeString(type)
    }

    override fun describeContents(): Int {
        return 0
    }

    companion object CREATOR : Parcelable.Creator<Images> {
        override fun createFromParcel(parcel1: Parcel): Images {
            return Images(parcel1)
        }
        override fun newArray(size: Int): Array<Images?> {
            return arrayOfNulls(size)
        }
    }
}
