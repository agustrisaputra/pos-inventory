Ownes:
    - id
    - username
    - name
    - phone
    - address
    - password

Companies:
    - id
    - owner_id
    - name
    - phone
    - address
    - description

Product Categories:
    - id
    - name
    - created_at
    - updated_at
    - deleted_at

Products:
    - id
    - product_category_id
    - code
    - name
    - product_price
    - resaller_price

Product Branchs:
    - id
    - branch_id
    - product_id
    - stock
    - branch_price

Packages:
    - id
    - code
    - name
    - stock
    - price
    - resaller_price

Package Product:
    - id
    - product_id
    - package_id
