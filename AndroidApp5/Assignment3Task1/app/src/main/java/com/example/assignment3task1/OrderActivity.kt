package com.example.assignment3task1

import android.annotation.SuppressLint
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.widget.ImageView
import android.widget.TextView

// Activity to display order details
class OrderActivity : AppCompatActivity() {
    // Function called when the activity is created
    @SuppressLint("SetTextI18n")
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_order)

        // Retrieve OrderDetails object passed from previous activity
        val order = intent.getParcelableExtra<OrderDetails>("order")

        // If order details are not null, populate UI elements with order information
        if (order!=null){
            // Find UI elements by their IDs
            val hotelimg: ImageView = findViewById(R.id.imageVieworderbg)
            val hotelname: TextView = findViewById(R.id.textViewaptname)
            val roomtype: TextView = findViewById(R.id.textViewroomtype)
            val checkin: TextView = findViewById(R.id.textViewcheckindate)
            val checkout: TextView = findViewById(R.id.textViewcheckoutdate)
            val totalamt: TextView = findViewById(R.id.textViewtotalorder)

            // Set image resource, hotel name, room type, check-in and check-out dates, and total amount
            hotelimg.setImageResource(order.image)
            hotelname.text = order.hotelname
            roomtype.text = "Room Type: ${order.roomtype}"
            checkin.text = "Check-In Date: ${order.checkindate}"
            checkout.text = "Check-Out Date: ${order.checkoutdate}"
            totalamt.text = "Total Amount: RM ${order.totalamt}"
        }
    }
}


































