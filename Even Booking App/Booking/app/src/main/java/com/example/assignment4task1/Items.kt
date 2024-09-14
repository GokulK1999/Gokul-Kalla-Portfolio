package com.example.assignment4task1

import android.os.Parcel
import android.os.Parcelable

// Data class representing items with details for events
data class Items(val type:String, val image:String, val title: String, val url:String,
    val date: String, val location: String):Parcelable {
        // Constructor for parcelable implementation
        constructor(parcel: Parcel) : this(
            parcel.readString()!!, // Type of event (social or professional)
            parcel.readString()!!, // Image representing the event
            parcel.readString()!!, // Title of the event
            parcel.readString()!!, // URL for more information about the event
            parcel.readString()!!, // Date of the event
            parcel.readString()!!){ // Location of the event
        }

    // Describe contents for parcelable
    override fun describeContents(): Int {
        // Not yet implemented
        TODO("Not yet implemented")
    }

    // Write to parcelable
    override fun writeToParcel(parcel: Parcel, p1: Int) {
        parcel.writeString(type)
        parcel.writeString(image)
        parcel.writeString(title)
        parcel.writeString(url)
        parcel.writeString(date)
        parcel.writeString(location)
    }

    // Companion object implementing Parcelable.Creator
    companion object CREATOR : Parcelable.Creator<Items> {
        // Create a new instance of Items from parcel
        override fun createFromParcel(parcel: Parcel): Items {
            return Items(parcel)
        }

        // Create a new array of Items
        override fun newArray(size: Int): Array<Items?> {
            return arrayOfNulls(size)
        }
    }
}

























































