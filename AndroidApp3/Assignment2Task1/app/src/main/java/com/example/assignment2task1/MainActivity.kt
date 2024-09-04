package com.example.assignment2task1

import android.annotation.SuppressLint
import android.os.Bundle
import android.widget.Button
import androidx.appcompat.app.AppCompatActivity
import android.widget.TextView
import android.widget.ImageView
import android.widget.Toast
import android.content.res.Configuration
import androidx.core.view.ViewCompat
import androidx.core.view.WindowInsetsCompat
import kotlin.random.Random

class MainActivity : AppCompatActivity() {
    private var totalScore = 0 // variable to store the total score
    private lateinit var scoreTextView: TextView // TextView to display the score
    private lateinit var imageView1: ImageView // ImageView for the first dice
    private lateinit var imageView2: ImageView // ImageView for the second dice
    private lateinit var btnRoll: Button // Button to roll the dice
    private var dice1Roll = 0 // Variable to store the value of the first dice roll
    private var dice2Roll = 0 //Variable to store the value of the second dice roll

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main) // Set the layout for the activity
        setSupportActionBar(findViewById(R.id.toolbar)) // Set the toolbar
        ViewCompat.setOnApplyWindowInsetsListener(findViewById(R.id.diceMain)) // Set padding for system bars
        {v, insets ->
            val systemBars = insets.getInsets(WindowInsetsCompat.Type.systemBars())
            v.setPadding(systemBars.left, systemBars.top, systemBars.right,systemBars.bottom)
            insets
        }

        InitUI() // Initialize the UI components

    }
    // Function to initialize UI components
    private fun InitUI(){
        scoreTextView = findViewById(R.id.scoreTextView)
        imageView1 = findViewById(R.id.dice1imageView)
        imageView2 = findViewById(R.id.dice2imageView)
        btnRoll = findViewById(R.id.rollButton)

        // Set click listener for the roll button
        btnRoll.setOnClickListener {
            rollDice() // Roll the dice
            updateScore(dice1Roll, dice2Roll) // Update the score based on the dice roll
        }
    }

    override fun onConfigurationChanged(newConfig: Configuration) {
        super.onConfigurationChanged(newConfig)
        // Show a toast message based on the device orientation
        // Use basic help of chatGTP for this specific part
        if (newConfig.orientation == Configuration.ORIENTATION_LANDSCAPE) {
            Toast.makeText(this, "Welcome to Landscape Mode", Toast.LENGTH_LONG).show()
            rollDice() // Roll the dice when in landscape mode
            orientationRollRules() // Apply rules for rolling based on orientation
        } else if (newConfig.orientation == Configuration.ORIENTATION_PORTRAIT) {
            Toast.makeText(this, "Welcome to Portrait Mode", Toast.LENGTH_LONG).show()
            rollDice() // Roll the dice when in portrait mode
            orientationRollRules() // Apply rules for rolling based on orientation
        }
    }

    // Function to roll the dice
    private fun rollDice() {
        val dice1 = Random.nextInt(1,7)
        dice1Roll = dice1
        // Set the image resource for the first dice based on the roll
        when (dice1) {
            1 -> imageView1.setImageResource(R.drawable.dice_one)
            2 -> imageView1.setImageResource(R.drawable.dice_two)
            3 -> imageView1.setImageResource(R.drawable.dice_three)
            4 -> imageView1.setImageResource(R.drawable.dice_four)
            5 -> imageView1.setImageResource(R.drawable.dice_five)
            6 -> imageView1.setImageResource(R.drawable.dice_six)
        }

        val dice2 = Random.nextInt(1,7)
        dice2Roll = dice2
        // Set the image resource for the second dice based on the roll
        when (dice2) {
            1 -> imageView2.setImageResource(R.drawable.dice_one)
            2 -> imageView2.setImageResource(R.drawable.dice_two)
            3 -> imageView2.setImageResource(R.drawable.dice_three)
            4 -> imageView2.setImageResource(R.drawable.dice_four)
            5 -> imageView2.setImageResource(R.drawable.dice_five)
            6 -> imageView2.setImageResource(R.drawable.dice_six)
        }

    }


    // Function to apply rules for rolling based on orientation
    private fun orientationRollRules() {
        if ((totalScore % 2 == 0 && (totalScore + (dice1Roll + dice2Roll)) % 2 == 0) &&
            !(dice1Roll == 6 && dice2Roll == 6) &&
            !(dice1Roll == 4 && dice2Roll == 4)
        ) {
            rollDice()
            orientationRollRules()
        } else if ((totalScore % 2 != 0 && (totalScore + (dice1Roll + dice2Roll)) % 2 != 0) &&
            !(dice1Roll == 6 && dice2Roll == 6) &&
            !(dice1Roll == 4 && dice2Roll == 4)
        ) {
            rollDice()
            orientationRollRules()
        } else {
            updateScore(dice1Roll, dice2Roll)
        }
    }

    // Function to update the score based on dice values
    // Able to implement this using own research
    @SuppressLint("StringFormatInvalid", "SetTextI18n")
    private fun updateScore(dice1Value: Int, dice2Value: Int) {
        if (dice1Value == 6 && dice2Value == 6) {
            totalScore *= 2
            showToast("Points are Doubled!! Your Total Score is: $totalScore")
        } else if (dice1Value == 4 && dice2Value == 4) {
            totalScore -= ((dice1Value + dice2Value) * 2)
            showToast("Your points got Minus!! Your Total Score is: $totalScore")
        } else {
            totalScore += dice1Value + dice2Value
            showToast("Total Score: $totalScore")
        }
        scoreTextView.text = "Total Score: $totalScore"
        scoreTextView.setText(("Total Score: $totalScore"))
    }

    // Function to show a toast message
    private fun showToast(message: String) {
        Toast.makeText(this, message, Toast.LENGTH_SHORT).show()
    }
}