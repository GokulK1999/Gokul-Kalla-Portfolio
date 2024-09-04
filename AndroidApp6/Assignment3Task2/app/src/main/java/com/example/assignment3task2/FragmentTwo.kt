package com.example.assignment3task2

import android.os.Bundle
import androidx.fragment.app.Fragment
import android.view.LayoutInflater
import android.view.View
import android.util.Log
import android.view.ViewGroup
import android.widget.ImageButton
import android.widget.RadioGroup
import android.widget.TextView
import androidx.appcompat.app.AlertDialog

/**
 * FragmentTwo class represents the second fragment of the sandwich ordering app.
 * This fragment displays the selected sandwich details and allows the user to place an order.
 */
class FragmentTwo : Fragment() {
    private lateinit var callBack: OnButtonClick

    // UI elements and properties for selecting and tracking options and prices
    lateinit var textViewPrice: TextView
    lateinit var imageButtonPlaceOrder: ImageButton
    lateinit var imageButtonReset: ImageButton
    var previousSelection = R.id.radioSize6
    var previousAddOnSelection = 0
    var total = 0.0
    var finalTotal = 0.0
    var priceSize = HashMap<String, Double>()
    var priceFilling = HashMap<String, Double>()
    var priceSide = HashMap<String, Double>()
    var cheapestFillingPrice = 0.0
    var cheapestSidePrice = 0.0
    var fillingCount = 0
    lateinit var selectedFillings: ArrayList<String>
    lateinit var selectedSide: ArrayList<String>
    var selectedAddOn = 0
    var radioButtonGroup = 0
    lateinit var myView: View
    lateinit var addOnRadioGroup: RadioGroup
    val addOnPrice = HashMap<String, Double>()

    /**
     * Interface for communication between FragmentTwo and its hosting activity.
     */
    interface OnButtonClick {
        fun passResetInfo(infoSandwich: Bundle)
    }

    private var sandwichBundle: Bundle? = null
    /**
     * Inflates the fragment's layout and initializes UI components.
     */
    override fun onCreateView(
        inflater: LayoutInflater, container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View {
        val myView = inflater.inflate(R.layout.fragment_two, container, false)
        initUI(myView)
        orderHandle()

        // Reset button click listener
        imageButtonReset.setOnClickListener {
            callBack.passResetInfo(Bundle())
        }

        callBack = activity as OnButtonClick

        // Swipe gesture listener
        myView.setOnTouchListener(object : OnSwipeTouchListener(requireContext()) {
            override fun onSwipeRight() {
                sandwichBundle?.let { callBack.passResetInfo(it) }
            }
        })

        return myView
    }


    /**
     * Retrieves data from arguments bundle when the fragment is created.
     */
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        arguments?.let { bundle ->
            sandwichBundle = bundle.getBundle("sandwichBundle")
            with(sandwichBundle) {
                // Retrieve selected sandwich details from the bundle
                previousSelection = this?.getInt("previousSelection") ?: 0
                selectedFillings = this?.getStringArrayList("selectedFillings") ?: ArrayList()
                selectedSide = this?.getStringArrayList("selectedSide") ?: ArrayList()
                priceFilling["Beef"] = 4.5
                priceSide["Cheese"] = 1.5
                cheapestFillingPrice = priceFilling["Beef"] ?: 0.0
                cheapestSidePrice = priceSide["Cheese"] ?: 0.0
                radioButtonGroup = this?.getInt("checkedRadioButtonGroup") ?: 0
                fillingCount = this?.getInt("fillingCount") ?: 0
                total = this?.getDouble("currentTotal") ?: 0.0
                selectedAddOn = this?.getInt("checkedAddOnRadio") ?: 0
                Log.d("MYTAG", "Total inside onCreate: $total")
            }
        }
    }

    /**
     * Event handler for add-on selection.
     */
    private fun addOnSelectionHandler() {
        addOnRadioGroup.setOnCheckedChangeListener { _, checkedId ->
            val previousPrice = when (previousAddOnSelection) {
                R.id.radioTea -> addOnPrice["Tea"] ?: 0.0
                R.id.radioCoffee -> addOnPrice["Coffee"] ?: 0.0
                R.id.radioFries -> addOnPrice["French Fries"] ?: 0.0
                else -> 0.0
            }
            val newPrice = when (checkedId) {
                R.id.radioTea -> addOnPrice["Tea"] ?: 0.0
                R.id.radioCoffee -> addOnPrice["Coffee"] ?: 0.0
                R.id.radioFries -> addOnPrice["French Fries"] ?: 0.0
                else -> 0.0
            }

            total -= previousPrice
            total += newPrice
            previousAddOnSelection = checkedId

            sandwichBundle?.putInt("checkedAddOnRadio", addOnRadioGroup.checkedRadioButtonId)
            Log.d("MYTAG", "Total addon: $total")
            textViewPrice.text = String.format("%.2f", total)
        }
    }

    /**
     * Initializes the UI components.
     */
    private fun initUI(view: View) {
        //initialize the UI
        textViewPrice = view.findViewById(R.id.textViewPrice)
        imageButtonPlaceOrder = view.findViewById(R.id.imageButtonPlaceOrder)
        imageButtonReset = view.findViewById(R.id.imageButtonReset)
        addOnRadioGroup = view.findViewById(R.id.radioButtonGroup2)
        addOnPrice["Tea"] = 3.5
        addOnPrice["Coffee"] = 4.5
        addOnPrice["French Fries"] = 5.0
        priceFilling["Ham"] = 2.5
        priceFilling["Chicken"] = 2.0
        priceFilling["Beef"] = 4.5
        priceFilling["Salmon"] = 3.7
        priceFilling["Kebab"] = 4.0
        priceSide["Tomato"] = 1.0
        priceSide["Lettuce"] = 1.2
        priceSide["Onion"] = 0.5
        priceSide["Cheese"] = 1.5
        priceSize["6 Inch"] = 7.0
        priceSize["9 Inch"] = 9.5
        priceSize["12 Inch"] = 13.0
        addOnSelectionHandler() // Set up add-on selection handler
        if(selectedAddOn!=0){
            addOnRadioGroup.check(selectedAddOn)
        }
        // Update total price based on selected add-on
        when (addOnRadioGroup.checkedRadioButtonId) {
            R.id.radioTea -> total -= addOnPrice["Tea"]!!
            R.id.radioCoffee -> total -= addOnPrice["Coffee"]!!
            R.id.radioFries -> total -= addOnPrice["French Fries"]!!
        }
        textViewPrice.setText(String.format("%.2f", total))
    }
    /**
     * Handles the order placement process.
     */
    private fun orderHandle(){
        imageButtonPlaceOrder.setOnClickListener{
            // Check if user has selected a filling
            if(fillingCount==0){
                val message = "Please select a Filling"
                val orderDialogBuilder = AlertDialog.Builder(requireContext())
                orderDialogBuilder.setMessage(message)
                    .setCancelable(false)
                    .setPositiveButton("Okay") { orderDialog, id ->
                        orderDialog.dismiss()
                    }
                val orderAlert = orderDialogBuilder.create()
                orderAlert.setTitle("Oops")
                orderAlert.show()
            }
            //calculate price including discount and display it
            //This structure is generated from AI, implemented my own logic after
            else {
                var message = ""
                val id = radioButtonGroup
                finalTotal += if (id == R.id.radioSize6) {
                    message += "Size 6 Inch: "+": RM"+ String.format("%.2f", priceSize["6 Inch"])+"\n"
                    priceSize["6 Inch"]!!
                } else if (id == R.id.radioSize9) {
                    message += "Size 9 Inch: "+": RM"+String.format("%.2f",priceSize["9 Inch"])+"\n"
                    priceSize["9 Inch"]!!
                } else {
                    message += "Size 12 Inch: "+": RM"+String.format("%.2f",priceSize["12 Inch"])+"\n"
                    priceSize["12 Inch"]!!
                }
                var cheapestFilling = ""
                for (filling in selectedFillings) {
                    message += filling +": RM"+String.format("%.2f",priceFilling[filling])+"\n"
                    finalTotal += priceFilling[filling]!!
                    if (priceFilling[filling]!! < cheapestFillingPrice) {
                        cheapestFillingPrice = priceFilling[filling]!!
                        cheapestFilling = filling
                    }
                }
                message += "Discounted Filling: "+ cheapestFilling +": RM -"+String.format("%.2f",
                    priceFilling[cheapestFilling])+"\n"
                var cheapestSide = ""
                for (side in selectedSide) {
                    message += side +": RM"+String.format("%.2f",priceSide[side])+"\n"
                    finalTotal += priceSide[side]!!
                    if (priceSide[side]!! < cheapestSidePrice) {
                        cheapestSidePrice = priceSide[side]!!
                        cheapestSide = side
                    }
                }
                message += "Discounted Side: "+ cheapestSide +": RM-"+String.format("%.2f",
                    priceSide[cheapestSide])+"\n"
                var addOnPriceDiscount: Double
                finalTotal += if (addOnRadioGroup.checkedRadioButtonId == R.id.radioTea) {
                    addOnPriceDiscount = addOnPrice["Tea"]!!
                    if(fillingCount==3){
                        addOnPriceDiscount*=0.8
                        message += "Add-On: Tea"+":RM"+String.format("%.2f", addOnPrice["Tea"]!!)+
                                " (- RM"+ String.format("%.2f", addOnPrice["Tea"]!!*0.2)+")"+"\n"
                    }
                    else {
                        message += "Add-On: Tea "+": RM"+String.format("%.2f", addOnPriceDiscount) +"\n"
                    }
                    addOnPriceDiscount
                } else if (addOnRadioGroup.checkedRadioButtonId == R.id.radioCoffee) {
                    addOnPriceDiscount = addOnPrice["Coffee"]!!
                    if(fillingCount==3) {
                        addOnPriceDiscount *= 0.8
                        message += "Add-On: Coffee " + ": RM" + String.format("%.2f",
                            addOnPrice["Coffee"]!!) +" (- RM"+ String.format("%.2f", addOnPrice["Coffee"]!!*0.2)+")"+"\n"
                    }
                    else {
                        message += "Add-On: Coffee " + ": RM" + String.format("%.2f", addOnPriceDiscount) + "\n"
                    }
                    addOnPriceDiscount
                } else if (addOnRadioGroup.checkedRadioButtonId == R.id.radioFries) {
                    addOnPriceDiscount = addOnPrice["French Fries"]!!
                    if(fillingCount==3) {
                        addOnPriceDiscount *= 0.8
                        message += "Add-On: French Fries" +": RM" + String.format("%.2f",addOnPrice["French Fries"]!!) +
                                " (- RM"+String.format("%.2f", addOnPrice["French Fries"]!!*0.2)+")"+"\n"
                    }
                    else {
                        message += "Add-On: French Fries" + ": RM" + String.format("%.2f", addOnPriceDiscount) +"\n"
                    }
                    addOnPriceDiscount
                }
                else{
                    0.0
                }
                finalTotal -= cheapestFillingPrice
                finalTotal -= cheapestSidePrice
                textViewPrice.text = String.format("%.2f", finalTotal)
                message += "======================\n"
                message += "Total: RM"+String.format("%.2f", finalTotal)+"\n"
                message += "======================\n"
                val orderDialogBuilder = AlertDialog.Builder(requireContext())
                orderDialogBuilder.setMessage(message)
                    .setCancelable(false)
                    .setPositiveButton("Yes") { orderDialog, id ->
                        orderDialog.dismiss()
                    }
                val orderAlert = orderDialogBuilder.create()
                orderAlert.setTitle("Your Order")
                orderAlert.show()
            }
            imageButtonReset.performClick()
        }
    }
    /**
     * Companion object to create a new instance of FragmentTwo.
     */
    companion object {
        @JvmStatic
        fun newInstance(infoSandwich: Bundle) = FragmentTwo().apply {
            arguments = Bundle(). apply {
                putBundle("sandwichBundle", infoSandwich) //pass infoSandwich as an argument
            }
        }
    }
}
