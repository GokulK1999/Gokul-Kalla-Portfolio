package com.example.assignment4task1

import androidx.appcompat.app.AppCompatActivity
import androidx.fragment.app.Fragment
import androidx.viewpager2.adapter.FragmentStateAdapter

// Adapter class for managing fragments in a ViewPager2
class viewadapter(appCompatActivity: AppCompatActivity, private val
tabTitles:Array<String>, private val itemsArray: ArrayList<Items>):
FragmentStateAdapter(appCompatActivity) {
    // Lists to store items for different event types
    var SocialEventList = ArrayList<Items>()
    var ProfessionalEventList = ArrayList<Items>()

    // Get the total number of tabs
    override fun getItemCount(): Int = tabTitles.size

    // Create fragments based on tab position
    override fun createFragment(position: Int): Fragment {
        when(position) {
            0 ->{
                // Filter items for social events
                for (item in itemsArray) {
                    if (item.type == "social"){
                        SocialEventList.add(item)
                    }
                }
                // Create a new instance of FragmentOne with social event items
                var loadFragment = FragmentOne.newInstance(SocialEventList)
                return loadFragment
            }
            else ->{
                // Filter items for professional events
                for (item in itemsArray){
                    if (item.type != "social"){
                        ProfessionalEventList.add(item)
                    }
                }
                // Create a new instance of FragmentTwo with professional event items
                var loadFragment = FragmentTwo.newInstance(ProfessionalEventList)
                return loadFragment
            }
        }
    }
}





























