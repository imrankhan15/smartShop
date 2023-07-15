<!DOCTYPE html>
<html>
	<head>
	<title> Business Mate</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href = "../css/bootstrap.min.css" rel="stylesheet">
	<link href = "../css/styles.css" rel ="stylesheet">
		
	</head>
	<body>
	<div class="navbar navbar-inverse navbar-static-top">
		<div class="container">
			<a class="navbar-brand">Business Mate</a>
			
			<button class ="navbar-toggle" data-toggle="collapse" data-target=".navHeaderCollapse">
			<span class ="icon-bar"></span>
			<span class ="icon-bar"></span>
			<span class ="icon-bar"></span>
			</button>
			
			<div class="collapse navbar-collapse navHeaderCollapse">
			
				<ul class="nav navbar-nav navbar-right">
					<li ><a href ="../homePage.php">Home</a></li>
					
					<li ><a href ="../logout.php">Log Out</a></li>
					<li ><a href ="../UserGuideTwo.php">UserGuide</a></li>
					<li ><a href ="../ContactTwo.php">Contact</a></li>
					<li class ="dropdown">
						<a href ="#" class="dropdown-toggle" data-toggle="dropdown">Owner<b class ="caret"></b></a>
						<ul class ="dropdown-menu">
							
							<li ><a href="../owner_section/ownerentry.php"> Owner Entry</a></li>
							<li ><a href="../owner_section/searchowner.php"> Show All Owners</a></li>
							<li ><a href="../owner_section/ownerTransactionEntry.php"> Owner Transaction Entry</a></li>
							<li ><a href="../owner_section/searchownertransactions.php"> Show all Owner Transactions </a></li>
					
							<li ><a href="../shop_section/shopentry.php"> Shop Entry</a></li>
							<li ><a href="../shop_section/searchshop.php"> Show All Shops</a></li>
						</ul>
					</li>
					
					<li class ="dropdown">
						<a href ="#" class="dropdown-toggle" data-toggle="dropdown">Customer, Staff & Supplier<b class ="caret"></b></a>
						<ul class ="dropdown-menu">
							<li ><a href="../customer_section/customerentry.php"> Customer Entry</a></li>
							<li ><a href="../customer_section/searchcustomer.php"> Show All Customers</a></li>
							<li ><a href="../stuff_section/stuffentry.php"> Staff Entry</a></li>
							<li ><a href="../stuff_section/searchstuff.php"> Show All Staff</a></li>
							<li ><a href="../stuff_section/stuffDailyHistory.php"> Enter Staff Daily History</a></li>
							<li ><a href="../stuff_section/searchStuffHistoryById.php"> Show Staff History</a></li>
							<li ><a href="../supplier_section/supplierentry.php"> Supplier Entry</a></li>
							<li ><a href="../supplier_section/searchsupplier.php"> Show All Suppliers</a></li>
							
						</ul>
					</li>
					<li class ="dropdown">
						<a href ="#" class="dropdown-toggle" data-toggle="dropdown">Item<b class ="caret"></b></a>
						<ul class ="dropdown-menu">
							
							<li ><a href="../item_section/itemSellPriceEntry.php"> Item Sell Price Entry</a></li>
							<li ><a href="../item_section/searchitem.php"> Show All Items</a></li>
							<li ><a href="../item_section/itemsell.php"> Item Sell Page </a></li>
							<li ><a href="../item_section/itembuy.php"> Item Buy Page </a></li>
							<li ><a href="../item_section/searchItemBuyByDate.php"> Search Item Buy  </a></li>
							<li ><a href="../item_section/searchItemSellByDate.php"> Search Item Sell  </a></li>
							<li ><a href="../item_section/corrupt_item_entry.php">Corrupt Item Entry</a></li>
							<li ><a href="../item_section/searchCorruptitems.php"> Show All Corrupt Items</a></li>
							<li ><a href="../item_section/searchSales.php"> Show Sales</a></li>
							<li ><a href="../item_section/searchBuys.php"> Show Buys</a></li>
							
						</ul>
					</li>
					<li class ="dropdown">
						<a href ="#" class="dropdown-toggle" data-toggle="dropdown">Other Cost & Due<b class ="caret"></b></a>
						<ul class ="dropdown-menu">
							<li ><a href="../otherCost_section/dailyOtherCostInsert.php"> Insert Other Cost </a></li>
							<li ><a href="../due_section/showSupplierDue.php"> Show Due to Supplier </a></li>
							<li ><a href="../due_section/paySupplierDue.php"> Pay Supplier Due </a></li>
							<li ><a href="../due_section/showCustomerDue.php"> Show Due by Customer </a></li>
							<li ><a href="../due_section/receiveCustomerDue.php"> Receive Customer Due</a></li>
						</ul>
					</li>
					
					<li class ="dropdown">
						<a href ="#" class="dropdown-toggle" data-toggle="dropdown">Bank<b class ="caret"></b></a>
						<ul class ="dropdown-menu">
						
							<li ><a href="../bank_history_section/bankentry.php"> Bank Transaction Entry</a></li>
							<li ><a href="../bank_history_section/searchbank.php"> Search All Bank Transactions</a></li>
							<li ><a href="../bank_history_section/searchBankTransaction.php"> Search Bank Transaction By Date</a></li>
						</ul>
					</li>
					<li class ="dropdown">
						<a href ="#" class="dropdown-toggle" data-toggle="dropdown">Daily Journal<b class ="caret"></b></a>
						<ul class ="dropdown-menu">
						
								
							<li ><a href="../journal_entry_section/dailyjournal.php"> Daily Journal</a></li>
							<li ><a href="../journal_entry_section/searchDailyJournal.php"> Show Daily Journal By Date</a></li>
							
						</ul>
					</li>
					<li class ="dropdown">
						<a href ="#" class="dropdown-toggle" data-toggle="dropdown">Report<b class ="caret"></b></a>
						<ul class ="dropdown-menu">
						
							
							<li ><a href="../balance_sheet_section/todaybalance.php"> Today </a></li>
							<li ><a href="../balance_sheet_section/weekbalance.php"> Last Week </a></li>
							<li ><a href="../balance_sheet_section/monthbalance.php"> Last Month </a></li>
							<li ><a href="../balance_sheet_section/yearbalance.php"> Last Year </a></li>
						
						</ul>
					</li>
					
				
				</ul>
				
			</div>
		</div>
	</div>
	
