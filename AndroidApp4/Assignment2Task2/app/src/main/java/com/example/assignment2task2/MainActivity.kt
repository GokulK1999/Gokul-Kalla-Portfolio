package com.example.assignment2task2

import android.annotation.SuppressLint
import android.os.Bundle
import androidx.activity.enableEdgeToEdge
import androidx.appcompat.app.AppCompatActivity
import androidx.core.view.ViewCompat
import androidx.core.view.WindowInsetsCompat
import android.view.View
import android.widget.CheckBox
import android.widget.ImageButton
import android.widget.RadioGroup
import android.widget.TextView
import android.widget.Toast
import androidx.appcompat.app.AlertDialog

class MyActivity : AppCompatActivity() {

    // UI Components
    private lateinit var myFillingCheckBoxes: Array<CheckBox>
    private lateinit var mySideCheckBoxes: Array<CheckBox>
    private lateinit var fillingTextViewSelection: TextView
    private lateinit var sideTextViewSelection: TextView
    private lateinit var placeOrderButton: ImageButton
    private lateinit var resetOrderButton: ImageButton
    private lateinit var totalPriceTextView: TextView
    private lateinit var sizeRadioGroup: RadioGroup

    // Data structures to hold selected fillings, sides, and size
    private val addMyFillings = mutableListOf<FillingItem>()
    private val addMySides = mutableListOf<SideItem>()
    private var selectedSize: String? = null
    private var selectedSizeCost = 0.0
    private var totalPrice = 0.0

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        // Enable edge-to-edge display
        enableEdgeToEdge()
        setContentView(R.layout.activity_main)

        // Applying window insets to handle display cutouts
        ViewCompat.setOnApplyWindowInsetsListener(findViewById(R.id.main)) { v, insets ->
            val systemBars = insets.getInsets(WindowInsetsCompat.Type.systemBars())
            v.setPadding(systemBars.left, systemBars.top, systemBars.right, systemBars.bottom)
            insets
        }
        // Initialize UI components and event listeners
        initUI()
        initCheckBox()
        initRadioGroup()
    }

    // Initialize UI components
    private fun initUI() {
        fillingTextViewSelection = findViewById(R.id.FillingSelection)
        sideTextViewSelection = findViewById(R.id.SideSelection)
        totalPriceTextView = findViewById(R.id.totalPriceRM)
        sizeRadioGroup = findViewById(R.id.selectionSize)
        myFillingCheckBoxes = arrayOf(
            findViewById(R.id.ham),
            findViewById(R.id.chicken),
            findViewById(R.id.beef),
            findViewById(R.id.salmon),
            findViewById(R.id.kebab)
        )
        mySideCheckBoxes = arrayOf(
            findViewById(R.id.tomato),
            findViewById(R.id.lettuce),
            findViewById(R.id.onion),
            findViewById(R.id.cheese)
        )
        placeOrderButton = findViewById(R.id.orderButton)
        resetOrderButton = findViewById(R.id.resetButton)

        placeOrderButton.setOnClickListener(placeOrderClickListener)
        resetOrderButton.setOnClickListener(resetOrderClickListener)
    }

    // Initialize filling and side checkboxes
    private fun initCheckBox() {
        // Data for filling options
        val myFillingData = mapOf(
            R.id.ham to FillingItem("Ham", 2.50),
            R.id.chicken to FillingItem("Chicken", 2.00),
            R.id.beef to FillingItem("Beef", 4.50),
            R.id.salmon to FillingItem("Salmon", 3.70),
            R.id.kebab to FillingItem("Kebab", 4.00)
        )

        // Data for side options
        val mySideData = mapOf(
            R.id.tomato to SideItem("Tomato", 1.00),
            R.id.lettuce to SideItem("Lettuce", 1.20),
            R.id.onion to SideItem("Onion", 0.50),
            R.id.cheese to SideItem("Cheese", 1.50)
        )

        // Handling filling checkbox selection
        myFillingCheckBoxes.forEach { myFillingCheckBox ->
            myFillingCheckBox.setOnCheckedChangeListener { fillingCheckButton, isChecked ->
                val checkBoxId = myFillingCheckBox.id
                val checkBoxInfo = myFillingData[checkBoxId]
                checkBoxInfo?.let { info ->
                    if (isChecked) {
                        addMyFillings.add(checkBoxInfo)
                        fillingTextViewSelection.text = info.name
                        calculateTotalPrice()
                        if (addMyFillings.count() == 3){
                            myFillingCheckBoxes.forEach { cbuncheck ->
                                if (!cbuncheck.isChecked) {
                                    cbuncheck.isEnabled = false
                                }
                            }
                        }
                    } else {
                        addMyFillings.remove(checkBoxInfo)
                        if (fillingTextViewSelection.text == info.name) {
                            fillingTextViewSelection.text = ""
                        }
                        calculateTotalPrice()
                        if (addMyFillings.count() < 3){
                            myFillingCheckBoxes.forEach { cbuncheck ->
                                if (!cbuncheck.isChecked) {
                                    cbuncheck.isEnabled = true
                                }
                            }
                        }
                    }
                }
            }
        }

        // Handling side checkbox selection
        mySideCheckBoxes.forEach { mySideCheckBox ->
            mySideCheckBox.setOnCheckedChangeListener { sideCheckButton, isChecked ->
                val checkBoxId = mySideCheckBox.id
                val checkBoxInfo = mySideData[checkBoxId]
                checkBoxInfo?.let { info ->
                    if (isChecked) {
                        addMySides.add(checkBoxInfo)
                        sideTextViewSelection.text = info.name
                        calculateTotalPrice()
                    } else {
                        addMySides.remove(checkBoxInfo)
                        if (sideTextViewSelection.text == info.name) {
                            sideTextViewSelection.text = ""
                        }
                        calculateTotalPrice()
                    }
                }
            }
        }
    }

    // Initializing radio group for selecting the size
    private fun initRadioGroup() {
        sizeRadioGroup.setOnCheckedChangeListener { _, checkedId ->
            selectedSize = when (checkedId) {
                R.id.size6 -> {
                    "6 inch"
                }
                R.id.size9 -> {
                    "9 inch"
                }
                R.id.size12 -> {
                    "12 inch"
                }
                else -> null
            }
            calculateTotalPrice()
        }
    }

    // Function to calculate total price according to filling and side
    @SuppressLint("SetTextI18n")
    private fun calculateTotalPrice() {
        totalPrice = 0.0
        var fillingsCost = 0.0
        var sidesCost = 0.0

        //Determine cost of selected size
        selectedSizeCost = when (selectedSize) {
            "6 inch" -> 7.0
            "9 inch" -> 9.5
            "12 inch" -> 13.0
            else -> 0.0 // This is default if no size is under selection
        }


        // Took Basic help from ChatGPT for this part particularly and later implemented logic according to task requirement
        // Calculate cost of fillings
        if (addMyFillings.size > 1) {
            fillingsCost = addMyFillings.sumOf { it.price } - (addMyFillings.minByOrNull { it.price }?.price ?: 0.0)
        }

        // Calculate cost of sides
        if (addMySides.size > 1) {
            sidesCost = addMySides.sumOf { it.price } - (addMySides.minByOrNull { it.price }?.price ?: 0.0)
        }

        // Calculate total price
        if (selectedSize != null && addMyFillings.size > 0 && addMySides.size > 0) {
            totalPrice = selectedSizeCost + fillingsCost + sidesCost
        }

        // Update total price display
        totalPriceTextView.text = "RM ${"%.2f".format(totalPrice)}"
    }

    // Handling place order button click
    private val placeOrderClickListener = View.OnClickListener {
        if (addMyFillings.size < 1 || addMySides.size < 1 || sizeRadioGroup.checkedRadioButtonId == -1) {
            Toast.makeText(this, "You must select at least one filling, one side, and a size" +
                    "before placing order", Toast.LENGTH_SHORT).show()
        } else {
            placeOrderDialogue()
        }
    }

    // Took basic help from ChatGPT for this part specifically and later implemented logic according to the task
    // Display the summary of order
    private fun placeOrderDialogue() {
        val message = StringBuilder()
        message.append("Selected Size:\n")
        message.append("${selectedSize} - RM${"%.2f".format(selectedSizeCost)}\n\n")

        message.append("Selected Fillings:\n")
        val sortedFillings = addMyFillings.sortedBy { it.price }
        sortedFillings.forEachIndexed { index, filling ->
            message.append("${filling.name} - RM${"%.2f".format(if (index == 0) 0.0 else filling.price)}\n")
        }
        message.append("\n")

        message.append("Selected Sides:\n")
        val sortedSides = addMySides.sortedBy { it.price }
        sortedSides.forEachIndexed { index, side ->
            message.append("${side.name} - RM${"%.2f".format(if (index == 0) 0.0 else side.price)}\n")
        }
        message.append("\n")

        message.append("===============\n")
        message.append("Total Price: RM${"%.2f".format(totalPrice)}\n")
        message.append("===============")

        val alertDialogBuilder = AlertDialog.Builder(this)
        alertDialogBuilder.setTitle("Order Summary")
        alertDialogBuilder.setMessage(message.toString())
        alertDialogBuilder.setPositiveButton("OK") { dialog, _ -> dialog.dismiss() }

        val alertDialog = alertDialogBuilder.create()
        alertDialog.show()
    }

    // Handling reset order button click
    private val resetOrderClickListener = View.OnClickListener {
        Toast.makeText(this, "All items reset.", Toast.LENGTH_SHORT).show()
        myFillingCheckBoxes.forEach { checkBox -> checkBox.isChecked = false }
        mySideCheckBoxes.forEach { checkBox -> checkBox.isChecked = false }
        addMyFillings.clear()
        addMySides.clear()
        sizeRadioGroup.clearCheck()
        selectedSize = null
        calculateTotalPrice()
    }
}