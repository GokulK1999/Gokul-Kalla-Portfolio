package com.example.assignment3task1

import android.os.Bundle
import android.content.Intent
import androidx.appcompat.app.AppCompatActivity
import androidx.recyclerview.widget.LinearLayoutManager
import androidx.recyclerview.widget.RecyclerView

// Main activity displaying a list of hotels
class MainActivity : AppCompatActivity() {
    // List of hotel details
    private var hotelList= ArrayList<Details>()
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main)

        // Populate the list of hotels
        populateHotelList()

        // Initialize RecyclerView and set its layout manager
        val recyclerView = findViewById<RecyclerView>(R.id.recyclerview)
        recyclerView.layoutManager = LinearLayoutManager(this)
        // Initialize and set adapter for RecyclerView
        val adapter = CustomAdapter(hotelList)
        recyclerView.adapter=adapter

        // Set item click listener for RecyclerView items
        adapter.onItemClick = {
            // Start DetailedActivity and pass the selected hotel details
            val intent = Intent(this, DetailedActivity::class.java)
            intent.putExtra("Hotel", it)
            startActivity(intent)
        }
    }

    // Function to populate the list of hotels with dummy data
    private fun populateHotelList() {
        hotelList.add(Details(R.drawable.room1,"Heritage Apartment", "Old Town Road", "5 Stars", "RM 500",
            "Room Size: 28 meter", "10 minutes to City Center", "Housekeeping Toiletries Wi-Fi Mini Bar",
            "Executive -RM 1200, Deluxe -RM 700, Superior -RM 500"))

        hotelList.add(Details(R.drawable.room2,"Ameron Hotel", "Shenton Way, Down Town", "3 Stars", "RM 300",
            "Room Size: 25 meter", "25 minutes to Subway", "Housekeeping Toiletries Wi-Fi Refrigerator",
            "Deluxe -RM 500, Superior -RM 415, Single -RM 300"))

        hotelList.add(Details(R.drawable.room3,"Dorsett Studio Apartment", "City Center", "4 Stars", "RM 415",
            "Room Size: 28 meter", "5 minutes to Bus Station", "Kitchenette Toiletries Wi-Fi Refrigerator",
            "Premier -RM 900, Deluxe -RM 600, Superior -RM 415"))

        hotelList.add(Details(R.drawable.room4,"Travelodge Harbourfront", "Harbourfront", "3 Stars", "RM 400",
            "Room Size: 20 meter", "1.5km to City Center", "Breakfast Toiletries Wi-Fi Refrigerator",
            "Family Room -RM 600, Deluxe -RM 400"))

        hotelList.add(Details(R.drawable.room5,"Clover Apartment", "East-West Coast", "2 Stars", "RM 200",
            "Room Size: 19 meter", "10km to City Center", "Toiletries Wi-Fi Drinking Water",
            "Deluxe -RM 450, Superior -RM 370, Single -RM 200"))

        hotelList.add(Details(R.drawable.room6,"Wonderloft Hostel", "China Town", "3 Stars", "RM 160",
            "Room Size: 30 meter", "220 meters to public transportation", "Wi-Fi Shower Laundry",
            "Premium Room -RM 350, Dormitory -RM 160"))
    }
}























