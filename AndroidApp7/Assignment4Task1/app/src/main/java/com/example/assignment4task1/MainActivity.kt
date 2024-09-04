package com.example.assignment4task1

import android.os.Bundle
import androidx.viewpager2.widget.ViewPager2
import androidx.appcompat.app.AppCompatActivity
import com.google.android.material.tabs.TabLayout
import com.google.android.material.tabs.TabLayoutMediator
import java.io.BufferedReader
import java.io.InputStreamReader
import android.widget.Toast

// Main activity responsible for displaying events and handling item clicks
class MainActivity : AppCompatActivity(), FragmentOne.OnClick {
    // Array to hold the event items
    var itemsarray = ArrayList<Items>()

    // Function called when the activity is created
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main)

        // Populate the array with event data
        populateArrays()

        // Initialize tab titles and layout
        val tabTitles = arrayOf("Social Event", "Professional Event")
        val tabLayout = findViewById<TabLayout>(R.id.tab_layout)
        val viewPager = findViewById<ViewPager2>(R.id.view_pager)

        // Set up view pager and attach tab layout
        viewPager.adapter = viewadapter(this, tabTitles, itemsarray)
        TabLayoutMediator(tabLayout, viewPager){ tab, position ->
            tab.text = tabTitles[position]
        }.attach()
    }

    // Function to populate the array with event data from a file
    private fun populateArrays() {
        // Open and read event data from a text file
        val inputStream = application.assets.open("data.txt")
        val reader = BufferedReader(InputStreamReader(inputStream))

        // Initialize variables to hold event details
        var type = ""
        var title = ""
        var date = ""
        var url = ""
        var location = ""
        var image = ""

        // Read each line of the file and parse event details
        var line: String? = reader.readLine()
        while (line != null) {
            val parts = line.split(":")
            when (parts[0]) {
                "type" -> type = parts[1].trim()
                "title" -> title = parts[1].trim()
                "date" -> date = parts[1].trim()
                "url" -> url = parts.drop(1).joinToString(":").trim() // Combine URL parts correctly
                "location" -> location = parts[1].trim()
                "image" -> {
                    // Extract image file name and add event item to the array
                    image = parts[1].substringBeforeLast(".png").trim()
                    itemsarray.add(Items(type, image, title, url, date, location))
                }
            }
            line = reader.readLine()
        }

        // Close the reader and input stream after parsing
        reader.close()
        inputStream.close()
    }

    // Function called when an event item is clicked
    override fun ClickItem(url: String) {
        // If the URL is not empty, open the corresponding web page
        if (url.isNotEmpty()) {
            val webFragment = FragmentWebView.newInstance(url)
            val transaction = supportFragmentManager.beginTransaction()
            transaction.replace(R.id.root_layout, webFragment)
            transaction.addToBackStack(null)
            transaction.commit()
        } else {
            // If the URL is empty, show a toast indicating the URL is not available
            Toast.makeText(this, "URL not available for this item", Toast.LENGTH_SHORT).show()
        }
    }
}
