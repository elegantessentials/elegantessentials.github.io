from typing import Dict
from pathlib import Path
class ProductTemplate:
    def __init__(self, template_file: str):
        self.template_file = template_file
        self.html_content = self._read_template()
        self.products_placeholder = '<!-- Example of one product card structure - repeat for others -->'

    def _read_template(self) -> str:
        with open(self.template_file, 'r', encoding='utf-8') as file:
            return file.read()

    def generate_product_html(self, product: Dict) -> str:
        return f'''
            <div class="product-card">
                <div class="product-image">
                    <img src="{product['image_url']}" alt="{product['title']}">
                </div>
                <div class="product-info">
                    <h3 class="product-title">{product['title']}</h3>
                    <div class="rating">
                        <span class="stars">{"⭐" * int(product['rating'])}</span>
                        <span class="review-count">{product['rating']} ({product['review_count']} reviews)</span>
                    </div>
                    <p class="purchase-info">{product['purchase_info']}</p>
                    <div class="price-block">
                        <span class="current-price">₹{int(product['current_price']):,}</span>
                        <span class="original-price">₹{int(product['original_price']):,}</span>
                        <span class="discount">{product['discount']}% off</span>
                    </div>
                </div>
            </div>'''

    def add_product(self, product: Dict):
        product_html = self.generate_product_html(product)
        # Replace placeholder with new product and keep placeholder for next product
        self.html_content = self.html_content.replace(
            self.products_placeholder,
            f"{product_html}\n            {self.products_placeholder}"
        )
        
        # Save the updated HTML
        with open(self.template_file, 'w', encoding='utf-8') as file:
            file.write(self.html_content)

def get_product_info():
    print("\n=== Enter Product Information ===")
    return {
        'image_url': input("Image URL: "),
        'title': input("Product Title: "),
        'rating': input("Rating (1-5): "),
        'review_count': input("Number of Reviews: "),
        'purchase_info': input("Purchase Info (e.g., '100+ bought in past month'): "),
        'current_price': input("Current Price (in ₹): "),
        'original_price': input("Original Price (in ₹): "),
        'discount': input("Discount Percentage: ")
    }

def main():
    template_file = 'laptop.html'
    template = ProductTemplate(template_file)
    
    while True:
        print("\n1. Add new product")
        print("2. Exit")
        choice = input("\nEnter your choice (1 or 2): ")
        
        if choice == '1':
            product = get_product_info()
            template.add_product(product)
            print("\nProduct added successfully!")
        elif choice == '2':
            print("\nExiting program...")
            break
        else:
            print("\nInvalid choice! Please try again.")

if __name__ == "__main__":
    main()