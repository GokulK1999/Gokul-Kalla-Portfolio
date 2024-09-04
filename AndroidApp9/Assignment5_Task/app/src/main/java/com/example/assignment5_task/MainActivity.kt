package com.example.assignment5_task

import android.os.Bundle
import androidx.appcompat.app.AppCompatActivity
import androidx.fragment.app.Fragment
import com.google.android.material.bottomnavigation.BottomNavigationView

class MainActivity : AppCompatActivity() {

    private val mainFragment = MainFragment()
    private val importantFragment = ImportantFragment()
    private val overdueFragment = OverdueFragment()
    private val completedFragment = CompletedFragment()

    private val onNavigationItemSelectedListener =
        BottomNavigationView.OnNavigationItemSelectedListener { item ->
            when (item.itemId) {
                R.id.menu_main -> {
                    replaceFragment(mainFragment)
                    return@OnNavigationItemSelectedListener true
                }
                R.id.menu_important -> {
                    replaceFragment(importantFragment)
                    return@OnNavigationItemSelectedListener true
                }
                R.id.menu_overdue -> {
                    replaceFragment(overdueFragment)
                    return@OnNavigationItemSelectedListener true
                }
                R.id.menu_completed -> {
                    replaceFragment(completedFragment)
                    return@OnNavigationItemSelectedListener true
                }
            }
            false
        }

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main)

        val bottomNavigationView = findViewById<BottomNavigationView>(R.id.bottom_navigation)
        bottomNavigationView.setOnNavigationItemSelectedListener(onNavigationItemSelectedListener)

        // Set main fragment as default
        replaceFragment(mainFragment)
    }

    private fun replaceFragment(fragment: Fragment) {
        supportFragmentManager.beginTransaction()
            .replace(R.id.fragment_container, fragment)
            .commit()
    }
}
