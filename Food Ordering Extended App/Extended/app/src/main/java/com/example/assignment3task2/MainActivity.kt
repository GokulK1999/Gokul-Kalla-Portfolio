package com.example.assignment3task2

import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle

class MainActivity: AppCompatActivity(), FragmentOne.onButtonClick,FragmentTwo.OnButtonClick {
    // Called when the activity is starting
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main)
        // Create an instance of FragmentOne
        val mainFragment = FragmentOne()

        // Add FragmentOne to the activity's layout
        supportFragmentManager.beginTransaction().add(R.id.root_layout, mainFragment)
            .addToBackStack(null).commit()
    }

    // Callback function implemented from FragmentOne.OnButtonClick interface
    // Receives a Bundle with reset information from FragmentOne
    override fun passResetInfo(infoSandwich: Bundle) {
        // Replace the current fragment with a new instance of FragmentOne
        val transaction = this.supportFragmentManager.beginTransaction()
        val mainFragment = FragmentOne.newInstance(infoSandwich)
        transaction.replace(R.id.root_layout, mainFragment)
        transaction.commit()
    }

    // Callback function implemented from FragmentTwo.OnButtonClick interface
    // Receives a Bundle with sandwich information from FragmentTwo
    override fun passDataOfSandwich(infoSandwich: Bundle) {
        // Replace the current fragment with a new instance of FragmentTwo
        val fragmentOrder = FragmentTwo.newInstance(infoSandwich)
        val transaction = this.supportFragmentManager.beginTransaction()
        transaction.replace(R.id.root_layout, fragmentOrder)
        transaction.commit()
    }
}
