import Login from './components/auth/Login';
import Register from './components/auth/Register';
import Forget from './components/auth/Forget';
import Logout from './components/auth/Logout';


// End Authentication
import Home from './components/Home';

// Module Employee
import Employee from './components/employee/index.vue';
import EmployeeCreate from './components/employee/create.vue';
import EmployeeEdit from './components/employee/edit.vue';

// Module Suppliers
import Suppliers from './components/supplier/index.vue';
import SupplierCreate from './components/supplier/create.vue';
import SupplierEdit from './components/supplier/edit.vue';

// Module Suppliers
import Categories from './components/category/index.vue';
import CategoryCreate from './components/category/create.vue';
import CategoryEdit from './components/category/edit.vue';

// Module Product
import Products from './components/product/index.vue';
import ProductCreate from './components/product/create.vue';
import ProductEdit from './components/product/edit.vue';

// Module Expense
import Expenses from './components/expense/expense.vue';
import ExpenseCreate from './components/expense/create.vue';
import ExpenseEdit from './components/expense/edit.vue';

// Module Salaries
import Salary from './components/salary/all_employee.vue';
import PaySalary from './components/salary/create.vue';
import AllSalary from './components/salary/index.vue';
import ViewSalary from './components/salary/view.vue';
import EditSalary from './components/salary/edit.vue';

// Stock Product
import Stock from './components/product/stock.vue';
import EditStock from './components/product/edit-stock.vue';

// Module Customer
import Customers from './components/customer/index.vue';
import CustomerCreate from './components/customer/create.vue';
import CustomerEdit from './components/customer/edit.vue';

// Module Pos
import Pos from './components/pos/pointofsale.vue';

// Module Order
import Order from './components/order/order.vue';
import ViewOrder from './components/order/view.vue';


export const routes = [
  { path: '/', component: Login, name: '/' },
  { path: '/login', component: Login, name: 'login' },
  { path: '/register', component: Register, name: 'register' },
  { path: '/forget', component: Forget, name: 'forget' },
  { path: '/logout', component: Logout, name: 'logout' },
  
  { path: '/home', component: Home, name: 'home' },

  // Employee for routes
  { path: '/employees', component: Employee, name: 'employes'},
  { path: '/store-employee', component: EmployeeCreate, name: 'store-employee'},
  { path: '/edit-employee/:id', component: EmployeeEdit, name: 'edit-employee'},

  // Employee for routes
  { path: '/suppliers', component: Suppliers, name: 'suppliers'},
  { path: '/store-supplier', component: SupplierCreate, name: 'store-supplier'},
  { path: '/edit-supplier/:id', component: SupplierEdit, name: 'edit-supplier'},

  // Category for routes
  { path: '/categories', component: Categories, name: 'categories'},
  { path: '/store-category', component: CategoryCreate, name: 'store-category'},
  { path: '/edit-category/:id', component: CategoryEdit, name: 'edit-category'},

  // Product for routes
  { path: '/products', component: Products, name: 'products'},
  { path: '/store-product', component: ProductCreate, name: 'store-product'},
  { path: '/edit-product/:id', component: ProductEdit, name: 'edit-product'},

  // Expense for routes
  { path: '/expenses', component: Expenses, name: 'expenses'},
  { path: '/store-expense', component: ExpenseCreate, name: 'store-expense'},
  { path: '/edit-expense/:id', component: ExpenseEdit, name: 'edit-expense'},

  // Salary for routes
  { path: '/given-salary', component: Salary, name: 'given-salary'},
  { path: '/pay-salary/:id', component: PaySalary, name: 'pay-salary'},
  { path: '/salary', component: AllSalary, name: 'salary'},
  { path: '/view-salary/:month', component: ViewSalary, name: 'view-salary'},
  { path: '/edit-salary/:id', component: EditSalary, name: 'edit-salary'},

  // Stock for routes
  { path: '/stock', component: Stock, name: 'stock'},
  { path: '/edit-stock/:id', component: EditStock, name: 'edit-stock'},

  // Customer for routes
  { path: '/customers', component: Customers, name: 'customers'},
  { path: '/store-customer', component: CustomerCreate, name: 'store-customer'},
  { path: '/edit-customer/:id', component: CustomerEdit, name: 'edit-customer'},

  // Pos for routes
  { path: '/pos', component: Pos, name: 'pos'},

  // Order for routes
  { path: '/order', component: Order, name: 'order'},
  { path: '/view-order/:id', component: ViewOrder, name: 'view-order'},
]