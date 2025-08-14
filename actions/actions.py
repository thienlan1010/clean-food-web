# This files contains your custom actions which can be used to run
# custom Python code.
#
# See this guide on how to implement these action:
# https://rasa.com/docs/rasa/custom-actions


# This is a simple example for a custom action which utters "Hello World!"

# from typing import Any, Text, Dict, List
#
# from rasa_sdk import Action, Tracker
# from rasa_sdk.executor import CollectingDispatcher
#
#
# class ActionHelloWorld(Action):
#
#     def name(self) -> Text:
#         return "action_hello_world"
#
#     def run(self, dispatcher: CollectingDispatcher,
#             tracker: Tracker,
#             domain: Dict[Text, Any]) -> List[Dict[Text, Any]]:
#
#         dispatcher.utter_message(text="Hello World!")
#
#         return []

# import mysql.connector
# from rasa_sdk import Action
# from rasa_sdk.events import SlotSet

# class ActionGetProductPrice(Action):
#     def name(self):
#         return "action_get_product_price"

#     def run(self, dispatcher, tracker, domain):
#         product_name = tracker.get_slot("product")

#         if not product_name:
#             dispatcher.utter_message(text="Bạn vui lòng nói rõ tên sản phẩm nhé!")
#             return []

#         print(f"DEBUG: Product name received - {product_name}")

#         # Kết nối CSDL MySQL
#         try:
#             conn = mysql.connector.connect(
#                 host="localhost",
#                 user="root",
#                 password="",
#                 database="nienluan"
#             )
#             cursor = conn.cursor(buffered=True)  #  Thêm buffered=True để tránh lỗi unread result
#             cursor.execute("SET NAMES utf8mb4;")


#             query = "SELECT GIA FROM san_pham WHERE LOWER(TENSP) LIKE LOWER(%s)"
#             cursor.execute(query, (f"%{product_name.strip()}%",))

#             result = cursor.fetchone()

#             print(f"DEBUG: Query result - {result}")      

#             cursor.close()
#             conn.close()

#             if result:
#                 price = result[0]
#                 dispatcher.utter_message(text=f"{product_name} có giá {price} VND.")
#             else:
#                 dispatcher.utter_message(text=f"Xin lỗi, tôi không tìm thấy giá của '{product_name}' trong hệ thống.")
                


#         except mysql.connector.Error as err:
#             dispatcher.utter_message(text="Có lỗi xảy ra khi truy vấn dữ liệu.")
#             print(f"MySQL Error: {err}")  # In lỗi ra console

#         except Exception as e:
#             dispatcher.utter_message(text="Có lỗi không xác định xảy ra.")
#             print(f"Unexpected Error: {str(e)}")

#         return []

# "SELECT GIA FROM san_pham WHERE TENSP LIKE %s"

# import mysql.connector
# from rasa_sdk import Action
# from rasa_sdk.events import SlotSet

# class ActionGetProductPrice(Action):
#     def name(self):
#         return "action_get_product_price"

#     def run(self, dispatcher, tracker, domain):
#         product_name = tracker.get_slot("product")

#         if not product_name:
#             dispatcher.utter_message(text="Bạn vui lòng nói rõ tên sản phẩm nhé!")
#             return []

#         print(f"DEBUG: Product name received - {product_name.strip()}")

#         # Kết nối CSDL MySQL
#         conn = None
#         cursor = None
#         try:
#             conn = mysql.connector.connect(
#                 host="localhost",
#                 user="root",
#                 password="",
#                 database="nienluan"
#             )
#             cursor = conn.cursor(buffered=True)  # ✅ Thêm buffered=True để tránh lỗi unread result

#             cursor.execute("SET NAMES utf8mb4;")

#             query = "SELECT GIA, LINKHINH FROM san_pham WHERE LOWER(TENSP) LIKE LOWER(%s)"
#             cursor.execute(query, (f"%{product_name.strip()}%",))

#             result = cursor.fetchone()  # Nếu có nhiều kết quả, có thể dùng fetchall()

#             print(f"DEBUG: Query result - {result}")

#             if result:
#                 price = result[0]
#                 dispatcher.utter_message(text=f"{product_name} có giá {price} VND.")
#             else:
#                 dispatcher.utter_message(text=f"Xin lỗi, tôi không tìm thấy giá của '{product_name}' trong hệ thống.")

#         except mysql.connector.Error as err:
#             dispatcher.utter_message(text="Có lỗi xảy ra khi truy vấn dữ liệu.")
#             print(f"MySQL Error: {err}")  # In lỗi chi tiết

#         except Exception as e:
#             dispatcher.utter_message(text="Có lỗi không xác định xảy ra.")
#             print(f"Unexpected Error: {str(e)}")

#         finally:
#             if cursor:
#                 cursor.close()
#             if conn:
#                 conn.close()

#         return []
#đúng nè
# import mysql.connector
# from rasa_sdk import Action

# class ActionGetProductPrice(Action):
#     def name(self):
#         return "action_get_product_price"

#     def run(self, dispatcher, tracker, domain):
#         product_name = tracker.get_slot("product")

#         if not product_name:
#             dispatcher.utter_message(text="Bạn vui lòng nói rõ tên sản phẩm nhé!")
#             return []

#         print(f"DEBUG: Product name received - {product_name.strip()}")

#         # Kết nối CSDL MySQL
#         conn = None
#         cursor = None
#         try:
#             conn = mysql.connector.connect(
#                 host="localhost",
#                 user="root",
#                 password="",
#                 database="nienluan"
#             )
#             cursor = conn.cursor(buffered=True)
#             cursor.execute("SET NAMES utf8mb4;")

#             query = "SELECT GIA, LINKHINH, TENSP FROM san_pham WHERE LOWER(TENSP) LIKE LOWER(%s)"
#             cursor.execute(query, (f"%{product_name.strip()}%",))

#             result = cursor.fetchone()

#             print(f"DEBUG: Query result - {result}")

#             if result:
#                 price, image_file, name_pro = result

#                 # ✅ Ghép đường dẫn ảnh đúng với nơi lưu ảnh trong thư mục
#                 base_url = "http://localhost/QL_Paionus-nhap/images/"  # Thay bằng domain thực tế nếu cần
#                 image_url = base_url + image_file  # Kết hợp với tên file trong database

#                 dispatcher.utter_message(
#                     text=f"{name_pro} có giá {price} VND.",
#                     image=image_url  # ✅ Gửi ảnh kèm tin nhắn
#                 )
#             else:
#                 dispatcher.utter_message(text=f"Xin lỗi, tôi không tìm thấy sản phẩm '{product_name}' trong hệ thống.")

#         except mysql.connector.Error as err:
#             dispatcher.utter_message(text="Có lỗi xảy ra khi truy vấn dữ liệu.")
#             print(f"MySQL Error: {err}")

#         except Exception as e:
#             dispatcher.utter_message(text="Có lỗi không xác định xảy ra.")
#             print(f"Unexpected Error: {str(e)}")

#         finally:
#             if cursor:
#                 cursor.close()
#             if conn:
#                 conn.close()

#         return []
#HỎI SẢN PHẨM CÓ GIÁ NHIÊU
import mysql.connector
from rasa_sdk import Action
from rasa_sdk.events import SlotSet
# tư vấn sp
class ActionGetProductPrice(Action):
    def name(self):
        return "action_get_product_price"

    def run(self, dispatcher, tracker, domain):
        product_name = tracker.get_slot("product")

        if not product_name:
            dispatcher.utter_message(text="Bạn vui lòng nói rõ tên sản phẩm nhé!")
            return []

        print(f"DEBUG: Product name received - {product_name.strip()}")

        conn = None
        cursor = None
        try:
            conn = mysql.connector.connect(
                host="localhost",
                user="root",
                password="",
                database="luanvan"
            )
            cursor = conn.cursor(buffered=True)
            cursor.execute("SET NAMES utf8mb4;")

            query = """
                SELECT sp.SP_MASP, sp.SP_TENSP, sp.SP_HINH, sp.SP_DONVI , dg_new.DG_GIAMOI
                FROM san_pham sp
                JOIN danh_muc dm ON sp.DM_MADM = dm.DM_MADM
                JOIN (
                    SELECT d1.*
                    FROM don_gia d1
                    WHERE d1.DG_ID = (
                        SELECT d2.DG_ID
                        FROM don_gia d2
                        WHERE d2.SP_MASP = d1.SP_MASP
                        ORDER BY d2.DG_NGAYAPDUNG DESC, d2.DG_ID DESC
                        LIMIT 1
                    )
                ) dg_new ON sp.SP_MASP = dg_new.SP_MASP
                WHERE dm.DM_TRANGTHAI = 'Còn kinh doanh'
                AND sp.SP_TRANGTHAI = 'Còn kinh doanh' 
                AND sp.SP_TENSP LIKE %s
            """
            cursor.execute(query, (f"%{product_name.strip()}%",))

            result = cursor.fetchone()

            print(f"DEBUG: Query result - {result}")

            if result:
                masp, tensp, hinh, donvi, giaban = result
                base_url = "http://localhost/LUAN_VAN/images/"
                image_url = base_url + hinh
                link = f"http://localhost/lUAN_VAN/index.php?act=chitiet&msp={masp}"
                dispatcher.utter_message(
                    text=f"""{tensp} có giá {giaban} VND/{donvi}.
                    <a href="{link}" >🔗 Xem chi tiết sản phẩm</a>""",
                    image=image_url,
                   
                )
                return [SlotSet("product", None)]
            else:
                dispatcher.utter_message(text=f"Xin lỗi, tôi không tìm thấy sản phẩm '{product_name}' trong hệ thống.")
                return [SlotSet("product", None)]
            
        except mysql.connector.Error as err:
            dispatcher.utter_message(text="Có lỗi xảy ra khi truy vấn dữ liệu.")
            print(f"MySQL Error: {err}")

        except Exception as e:
            dispatcher.utter_message(text="Có lỗi không xác định xảy ra.")
            print(f"Unexpected Error: {str(e)}")

        finally:
            if cursor:
                cursor.close()
            if conn:
                conn.close()

        return []

#giá dưới bao nhiêu hoặc hơn VD: có rau nào dưới 5000 ko? 
# class ActionFilterProducts(Action):
#     def name(self):
#         return "action_filter_products"

#     def run(self, dispatcher, tracker, domain):
#         category = tracker.get_slot("category")
#         price = tracker.get_slot("price")

#         print(f"DEBUG: Filtering with product = {category}, price = {price}")

#         conn = None
#         cursor = None
#         try:
#             conn = mysql.connector.connect(
#                 host="localhost",
#                 user="root",
#                 password="",
#                 database="luanvan"
#             )
#             cursor = conn.cursor(buffered=True)
#             cursor.execute("SET NAMES utf8mb4;")
        
#             query = """
#                 SELECT sp.SP_MASP, sp.SP_TENSP, sp.SP_DONVI, dg_new.DG_GIAMOI, sp.SP_HINH, dm.DM_TENDM
#                 FROM san_pham sp
#                 JOIN danh_muc dm ON sp.DM_MADM = dm.DM_MADM
#                 JOIN (
#                     SELECT d1.*
#                     FROM don_gia d1
#                     WHERE d1.DG_ID = (
#                         SELECT d2.DG_ID
#                         FROM don_gia d2
#                         WHERE d2.SP_MASP = d1.SP_MASP
#                         ORDER BY d2.DG_NGAYAPDUNG DESC, d2.DG_ID DESC
#                         LIMIT 1
#                     )
#                 ) dg_new ON sp.SP_MASP = dg_new.SP_MASP
#                 WHERE dm.DM_TRANGTHAI = 'Còn kinh doanh'
#                 AND sp.SP_TRANGTHAI = 'Còn kinh doanh'
#             """
#             params = []

#             # Xử lý category
#             if category:
#                 query += " AND sp.SP_TENSP LIKE %s"
#                 params.append(f"%{category.strip()}%")

#             # Xử lý comparison_operator
#             comparison = tracker.get_slot("comparison_operator")
#             operator = "<"   #Mặc định là "dưới/rẻ hơn"

#             if comparison:
#                 comparison = comparison.lower()
#                 if comparison in ["trên", "cao hơn"]:
#                     operator = ">"
#                 elif comparison in ["dưới", "rẻ hơn"]:
#                     operator = "<"

#             # Xử lý price
#             if price:
#                 query += f" AND dg_new.DG_GIAMOI {operator} %s"
#                 params.append(float(price))

#             # Thực thi truy vấn
#             cursor.execute(query, tuple(params))
#             results = cursor.fetchall()

#             print(f"DEBUG: Filter query returned {len(results)} results")
           

#             if results:
#                 base_url = "http://localhost/LUAN_VAN/images/"
#                 for masp, name, donvi, gia, hinh, tendm in results:
#                     image_url = base_url + hinh
#                     link = f"http://localhost/lUAN_VAN/index.php?act=chitiet&msp={masp}"
#                     print(f"DEBUG IMAGE URL: {image_url}")
#                     dispatcher.utter_message(
#                         text=f"""{name} - {gia} VND/{donvi} ({tendm}).
#                         <a href="{link}" >🔗 Xem chi tiết sản phẩm</a>""",
#                         image=image_url
                        
#                     )
#             else:
#                 dispatcher.utter_message(text="Không tìm thấy sản phẩm phù hợp với yêu cầu của bạn.")
            
#         except mysql.connector.Error as err:
#             dispatcher.utter_message(text="Có lỗi xảy ra khi truy vấn dữ liệu.")
#             print(f"MySQL Error: {err}")

#         except Exception as e:
#             dispatcher.utter_message(text="Có lỗi không xác định xảy ra.")
#             print(f"Unexpected Error: {str(e)}")

#         finally:
#             if cursor:
#                 cursor.close()
#             if conn:
#                 conn.close()

#         return []
class ActionFilterProducts(Action):
    def name(self):
        return "action_filter_products"

    def run(self, dispatcher, tracker, domain):
        category = tracker.get_slot("category")
        price = tracker.get_slot("price")
        comparison = tracker.get_slot("comparison_operator")

        print(f"DEBUG: category={category}, price={price}, comparison={comparison}")

        conn = None
        cursor = None

        try:
            conn = mysql.connector.connect(
                host="localhost",
                user="root",
                password="",
                database="luanvan"
            )
            cursor = conn.cursor(buffered=True)
            cursor.execute("SET NAMES utf8mb4;")

            # Lấy danh sách danh mục hợp lệ
            cursor.execute("SELECT DM_TENDM FROM danh_muc WHERE DM_TRANGTHAI = 'Còn kinh doanh'")
            rows = cursor.fetchall()
            danh_muc = [row[0].lower().strip() for row in rows]

            query = """
                SELECT sp.SP_MASP, sp.SP_TENSP, sp.SP_DONVI, dg_new.DG_GIAMOI, sp.SP_HINH, dm.DM_TENDM
                FROM san_pham sp
                JOIN danh_muc dm ON sp.DM_MADM = dm.DM_MADM
                JOIN (
                    SELECT d1.*
                    FROM don_gia d1
                    WHERE d1.DG_ID = (
                        SELECT d2.DG_ID
                        FROM don_gia d2
                        WHERE d2.SP_MASP = d1.SP_MASP
                        ORDER BY d2.DG_NGAYAPDUNG DESC, d2.DG_ID DESC
                        LIMIT 1
                    )
                ) dg_new ON sp.SP_MASP = dg_new.SP_MASP
                WHERE dm.DM_TRANGTHAI = 'Còn kinh doanh'
                AND sp.SP_TRANGTHAI = 'Còn kinh doanh'
            """
            params = []

            # Nếu có category
            if category:
                clean_category = category.lower().strip()
                if clean_category in danh_muc:
                    query += " AND dm.DM_TENDM LIKE %s"
                    params.append(f"{clean_category}%")
                else:
                    # Không nằm trong danh mục → coi như là tên sản phẩm
                    query += " AND sp.SP_TENSP LIKE %s"
                    params.append(f"%{clean_category}%")

            # Xử lý operator so sánh giá
            operator = "<"  # mặc định là "dưới"
            if comparison:
                comparison = comparison.lower()
                if comparison in ["trên", "cao hơn", "lớn hơn", "hơn"]:
                    operator = ">"
                elif comparison in ["dưới", "rẻ hơn", "thấp hơn", "ít hơn", "nhỏ hơn"]:
                    operator = "<"

            # Lọc theo giá nếu có
            if price:
                query += f" AND dg_new.DG_GIAMOI {operator} %s"
                params.append(float(price))

            # print(f"DEBUG QUERY: {query}")
            # print(f"DEBUG PARAMS: {params}")

            cursor.execute(query, tuple(params))
            results = cursor.fetchall()

            if results:
                base_url = "http://localhost/LUAN_VAN/images/"
                for masp, name, donvi, gia, hinh, tendm in results:
                    image_url = base_url + hinh
                    link = f"http://localhost/LUAN_VAN/index.php?act=chitiet&msp={masp}"
                    dispatcher.utter_message(
                        text=f"""{name} - {gia} VND/{donvi} 
                        🔗 <a href="{link}">Xem chi tiết sản phẩm</a>""",
                        image=image_url
                    )
            else:
                dispatcher.utter_message(text="Không tìm thấy sản phẩm phù hợp với yêu cầu của bạn.")

        except mysql.connector.Error as err:
            dispatcher.utter_message(text="Có lỗi xảy ra khi truy vấn dữ liệu.")
            print(f"MySQL Error: {err}")

        except Exception as e:
            dispatcher.utter_message(text="Có lỗi không xác định xảy ra.")
            print(f"Unexpected Error: {str(e)}")

        finally:
            if cursor:
                cursor.close()
            if conn:
                conn.close()

        return []


#tư vấn sản phẩm
import mysql.connector
from rasa_sdk import Action
from rasa_sdk.executor import CollectingDispatcher
from rasa_sdk.events import SlotSet

class ActionRecommendFoodByCondition(Action):
    def name(self):
        return "action_recommend_food_by_condition"

    def run(self, dispatcher: CollectingDispatcher, tracker, domain):

        condition = tracker.get_slot("health")
        print(f"DEBUG: Filtering with condition = {condition}")
        if not condition:
            dispatcher.utter_message(text="Bạn vui lòng cho biết tình trạng sức khỏe của mình (ví dụ: cao huyết áp, tiểu đường...)")
            return []

        try:
            conn = mysql.connector.connect(
                host="localhost",
                user="root",
                password="",
                database="luanvan",
                charset='utf8'
            )
            cursor = conn.cursor()
            query = """
                SELECT sp.SP_TENSP, ph.PH_Mota
                FROM san_pham sp
                JOIN phuhop ph ON sp.SP_MaSP = ph.SP_MaSP
                JOIN the_trang tt ON ph.TTRANG_MA = tt.TTRANG_MA
                WHERE LOWER(tt.TTRANG_Ten) LIKE %s
            """
            cursor.execute(query, (f"%{condition.lower()}%",))
            results = cursor.fetchall()

            if results:
                reply = f"🔍 Với tình trạng **{condition}**, bạn nên dùng:\n"
                for name, note in results:
                    reply += f"• {name}: {note}\n"     
                dispatcher.utter_message(text=reply)           
            else:
                reply = f"❗ Hiện chưa có thực phẩm phù hợp trong hệ thống cho tình trạng '{condition}'."

                dispatcher.utter_message(text=reply)
                # Luôn reset slot sau khi trả lời
            return [SlotSet("health", None)]
              
        except mysql.connector.Error as err:
            dispatcher.utter_message(text="⚠️ Lỗi truy vấn cơ sở dữ liệu.")
            print(f"MySQL Error: {err}")
           
        
        finally:
            if conn:
                conn.close()

        return []


#hỏi cà chua có phù hợp với bị béo phì không
import mysql.connector
from rasa_sdk import Action
from rasa_sdk.executor import CollectingDispatcher
from rasa_sdk.events import SlotSet


class ActionRecommendFoodByCondition(Action):
    def name(self):
        return "action_recommend_food"

    def run(self, dispatcher: CollectingDispatcher, tracker, domain):

        condition = tracker.get_slot("health_condition")
        food = tracker.get_slot("food")
        print(f"DEBUG: Filtering with condition = {condition}, food = {food}")

        if not condition or not food:
            dispatcher.utter_message(text="❗ Bạn vui lòng cung cấp đầy đủ tên thực phẩm và tình trạng sức khỏe.")
            return []

        try:
            conn = mysql.connector.connect(
                host="localhost",
                user="root",
                password="",
                database="luanvan",
                charset='utf8'
            )
            cursor = conn.cursor()

            # Truy vấn xem thực phẩm đó có phù hợp với tình trạng sức khỏe không
            query = """
                SELECT sp.SP_TENSP, tt.TTRANG_Ten, ph.PH_Mota
                FROM san_pham sp
                JOIN phuhop ph ON sp.SP_MaSP = ph.SP_MaSP
                JOIN the_trang tt ON ph.TTRANG_MA = tt.TTRANG_MA
                WHERE LOWER(sp.SP_TENSP) LIKE %s AND LOWER(tt.TTRANG_Ten) LIKE %s
            """
            cursor.execute(query, (f"%{food.lower()}%", f"%{condition.lower()}%"))
            result = cursor.fetchone()

            # if result:
            #     ten_sp, ten_tt, mota = result
            #     reply = f"✅ '{ten_sp}' có phù hợp cho người bị '{ten_tt}'.\n📌 Ghi chú: {mota}"
            #     dispatcher.utter_message(text=reply)
            #     return [
            #         SlotSet("food", None),
            #         SlotSet("health_condition", None)
            #     ]
            # else:
            #     reply = f"❌ Hiện tại chưa có thông tin '{food}' có phù hợp với '{condition}' trong hệ thống."
            #     dispatcher.utter_message(text=reply)
            #     return [
            #         SlotSet("food", None),
            #         SlotSet("health_condition", None)
            #     ]
            if result:
                ten_sp, ten_tt, mota = result
                reply = f"✅ '{ten_sp}' có phù hợp cho người bị '{ten_tt}'.\n📌 Ghi chú: {mota}"
            else:
                reply = f"❌ Hiện tại chưa có thông tin '{food}' có phù hợp với '{condition}' trong hệ thống."

            dispatcher.utter_message(text=reply)
            return [
                SlotSet("food", None),
                SlotSet("health_condition", None)
            ]

        except mysql.connector.Error as err:
            dispatcher.utter_message(text="⚠️ Lỗi truy vấn cơ sở dữ liệu.")
            print(f"MySQL Error: {err}")

        finally:
            if conn:
                conn.close()

        return []

#sản phẩm nên tránh
from rasa_sdk import Action
from rasa_sdk.executor import CollectingDispatcher

class ActionRecommendFoodAdvoi(Action):
    def name(self):
        return "action_food_to_avoid"

    def run(self, dispatcher: CollectingDispatcher, tracker, domain):

        condition = tracker.get_slot("health_advoi")
        dk = tracker.get_slot("avoid")

        print(f"DEBUG: Filtering with condition = {condition}, avoid = {dk}")
        if not condition or not dk:
            dispatcher.utter_message(text="❗ Bạn vui lòng cung cấp tên tình trạng sức khỏe.")
            return []

        # Vì chưa có dữ liệu nên không truy vấn SQL
        reply = f"📌 Hiện tại hệ thống chưa có thông tin về các thực phẩm nên tránh cho tình trạng '{condition}'.\nChúng tôi sẽ cập nhật sớm!"

        dispatcher.utter_message(text=reply)
        return []

#hỏi có bán sp A hay ko
import mysql.connector
from rasa_sdk import Action
from rasa_sdk.executor import CollectingDispatcher
from rasa_sdk.events import SlotSet

class ActionRecommendCoBanSp(Action):
    def name(self):
        return "action_co_ban_sp"

    def run(self, dispatcher: CollectingDispatcher, tracker, domain):

        sanpham = tracker.get_slot("sanpham")
       
        print(f"DEBUG: Filtering with sanpham = {sanpham}")

        if not sanpham :
            dispatcher.utter_message(text="❗ Bạn vui lòng cung cấp đầy đủ tên thực phẩm muốn hỏi.")
            return []

        try:
            conn = mysql.connector.connect(
                host="localhost",
                user="root",
                password="",
                database="luanvan",
                charset='utf8'
            )
            cursor = conn.cursor()

            # Truy vấn xem thực phẩm đó có phù hợp với tình trạng sức khỏe không
            query = """
                SELECT sp.SP_MASP, sp.SP_TENSP, sp.SP_HINH, sp.SP_DONVI , dg_new.DG_GIAMOI
                FROM san_pham sp
                JOIN danh_muc dm ON sp.DM_MADM = dm.DM_MADM
                JOIN (
                    SELECT d1.*
                    FROM don_gia d1
                    WHERE d1.DG_ID = (
                        SELECT d2.DG_ID
                        FROM don_gia d2
                        WHERE d2.SP_MASP = d1.SP_MASP
                        ORDER BY d2.DG_NGAYAPDUNG DESC, d2.DG_ID DESC
                        LIMIT 1
                    )
                ) dg_new ON sp.SP_MASP = dg_new.SP_MASP
                WHERE dm.DM_TRANGTHAI = 'Còn kinh doanh'
                AND sp.SP_TRANGTHAI = 'Còn kinh doanh' 
                AND  sp.SP_TENSP LIKE %s
                LIMIT 1
            """
            cursor.execute(query, (f"%{sanpham.strip()}%",))

            result = cursor.fetchone()

            print(f"DEBUG: Query result - {result}")

            # if result:
            #     masp, tensp, hinh, donvi, giaban = result
            #     base_url = "http://localhost/LUAN_VAN/images/"
            #     image_url = base_url + hinh

            #     dispatcher.utter_message(
            #         text=f"{tensp} có giá {giaban} VND/{donvi}.",
            #         image=image_url
            #     )
            # else:
            #     reply = f"❌ Hiện tại cửa hàng chưa có sản phẩm '{sanpham}'trong hệ thống."

            # dispatcher.utter_message(text=reply)
            if result:
                masp, tensp, hinh, donvi, giaban = result
                base_url = "http://localhost/LUAN_VAN/images/"
                image_url = base_url + hinh
                link = f"http://localhost/lUAN_VAN/index.php?act=chitiet&msp={masp}"

                dispatcher.utter_message(
                    text=f"""{tensp} có giá {giaban} VND/{donvi}.
                    <a href="{link}" >🔗 Xem chi tiết sản phẩm</a>""",
                    image=image_url
                )
                return [SlotSet("sanpham", None)]
            else:
                reply = f"❌ Hiện tại cửa hàng không có sản phẩm '{sanpham}' trong hệ thống."
                dispatcher.utter_message(text=reply)  # gọi trong else luôn
                return [SlotSet("sanpham", None)]

        except mysql.connector.Error as err:
            dispatcher.utter_message(text="⚠️ Lỗi truy vấn cơ sở dữ liệu.")
            print(f"MySQL Error: {err}")

        finally:
            if conn:
                conn.close()

        return []
    
#hỏi về loại -> có những loại nào
import mysql.connector
from rasa_sdk import Action
from rasa_sdk.executor import CollectingDispatcher
from rasa_sdk.events import SlotSet

class ActionRecommendLoaiSanPham(Action):
    def name(self):
        return "action_loai_sp"

    def run(self, dispatcher: CollectingDispatcher, tracker, domain):

        loai = tracker.get_slot("loai")

        print(f"DEBUG: Filtering with loai = {loai}")

        if not loai:
            dispatcher.utter_message(text="❗ Bạn vui lòng cung cấp đầy đủ tên loại thực phẩm muốn hỏi.")
            return []

        try:
            conn = mysql.connector.connect(
                host="localhost",
                user="root",
                password="",
                database="luanvan",
                charset='utf8'
            )
            cursor = conn.cursor()

            # Từ khóa danh mục
            # danh_muc_mapping = ["trái cây", "rau", "củ quả", "thịt heo", "thịt bò", "thịt gà", "hải sản", "sữa tươi", "sữa đặc", "sữa chua", "trứng", "cá"]
            cursor.execute("SELECT DM_TENDM FROM danh_muc WHERE DM_TRANGTHAI = 'Còn kinh doanh'")
            rows = cursor.fetchall()
            danh_muc_mapping = [row[0].lower().strip() for row in rows]


            loai_lower = loai.lower().strip()

            if loai_lower in danh_muc_mapping:
                # Truy theo danh mục
                query = """
                   SELECT sp.SP_MASP, sp.SP_TENSP, sp.SP_HINH, sp.SP_DONVI, dg_new.DG_GIAMOI
                    FROM san_pham sp
                    JOIN danh_muc dm ON sp.DM_MADM = dm.DM_MADM
                    JOIN (
                        SELECT d1.*
                        FROM don_gia d1
                        WHERE d1.DG_ID = (
                            SELECT d2.DG_ID
                            FROM don_gia d2
                            WHERE d2.SP_MASP = d1.SP_MASP
                            ORDER BY d2.DG_NGAYAPDUNG DESC, d2.DG_ID DESC
                            LIMIT 1
                        )
                    ) dg_new ON sp.SP_MASP = dg_new.SP_MASP
                    WHERE dm.DM_TRANGTHAI = 'Còn kinh doanh'
                    AND sp.SP_TRANGTHAI = 'Còn kinh doanh'
                    AND dm.DM_TENDM LIKE %s

                """
                cursor.execute(query, (f"{loai_lower}%",))
            else:
                # Truy theo tên sản phẩm
                query = """
                    SELECT sp.SP_MASP, sp.SP_TENSP, sp.SP_HINH, sp.SP_DONVI, dg_new.DG_GIAMOI
                    FROM san_pham sp
                    JOIN danh_muc dm ON sp.DM_MADM = dm.DM_MADM
                    JOIN (
                        SELECT d1.*
                        FROM don_gia d1
                        WHERE d1.DG_ID = (
                            SELECT d2.DG_ID
                            FROM don_gia d2
                            WHERE d2.SP_MASP = d1.SP_MASP
                            ORDER BY d2.DG_NGAYAPDUNG DESC, d2.DG_ID DESC
                            LIMIT 1
                        )
                    ) dg_new ON sp.SP_MASP = dg_new.SP_MASP
                    WHERE dm.DM_TRANGTHAI = 'Còn kinh doanh'
                    AND sp.SP_TRANGTHAI = 'Còn kinh doanh'
                    AND sp.SP_TENSP LIKE %s
                """
                cursor.execute(query, (f"{loai_lower}%",))

            results = cursor.fetchall()

            print(f"DEBUG: Query result - {results}")

            if results:
                base_url = "http://localhost/LUAN_VAN/images/"
                for masp, tensp, hinh, donvi, giaban in results:
                    image_url = base_url + hinh
                    link = f"http://localhost/lUAN_VAN/index.php?act=chitiet&msp={masp}"

                    dispatcher.utter_message(
                        text=f"""{tensp} - {giaban} VND/{donvi}
                        <a href="{link}" >🔗 Xem chi tiết sản phẩm</a>""",
                        image=image_url
                    )
                return [SlotSet("loai", None)]
            else:
                dispatcher.utter_message(text=f"❌ Hiện tại cửa hàng không có sản phẩm thuộc loại '{loai}'.")
                return [SlotSet("loai", None)]
        except mysql.connector.Error as err:
            dispatcher.utter_message(text="⚠️ Lỗi truy vấn cơ sở dữ liệu.")
            print(f"MySQL Error: {err}")

        finally:
            if conn:
                conn.close()

        return []

#hỏi còn hàng sản phẩm ko
import mysql.connector
from rasa_sdk import Action
from rasa_sdk.executor import CollectingDispatcher

class ActionRecommendConHang(Action):
    def name(self):
        return "action_con_hang"

    def run(self, dispatcher: CollectingDispatcher, tracker, domain):

        sanpham = tracker.get_slot("tensp")
       
        print(f"DEBUG: Filtering with sanpham = {sanpham}")

        if not sanpham :
            dispatcher.utter_message(text="❗ Bạn vui lòng cung cấp đầy đủ tên thực phẩm muốn hỏi.")
            return []

        try:
            conn = mysql.connector.connect(
                host="localhost",
                user="root",
                password="",
                database="luanvan",
                charset='utf8'
            )
            cursor = conn.cursor()

            # Truy vấn xem thực phẩm đó có phù hợp với tình trạng sức khỏe không
            query = """
                SELECT sp.SP_MASP, sp.SP_TENSP, sp.SP_HINH, sp.SP_DONVI , dg_new.DG_GIAMOI, sp.SP_SLTON
                FROM san_pham sp
                JOIN danh_muc dm ON sp.DM_MADM = dm.DM_MADM
                JOIN (
                    SELECT d1.*
                    FROM don_gia d1
                    WHERE d1.DG_ID = (
                        SELECT d2.DG_ID
                        FROM don_gia d2
                        WHERE d2.SP_MASP = d1.SP_MASP
                        ORDER BY d2.DG_NGAYAPDUNG DESC, d2.DG_ID DESC
                        LIMIT 1
                    )
                ) dg_new ON sp.SP_MASP = dg_new.SP_MASP
                WHERE dm.DM_TRANGTHAI = 'Còn kinh doanh'
                AND sp.SP_TRANGTHAI = 'Còn kinh doanh' 
                AND sp.SP_TENSP LIKE %s
                LIMIT 1
            """
            cursor.execute(query, (f"{sanpham.strip()}%",))

            result = cursor.fetchone()

            print(f"DEBUG: Query result - {result}")

            if result:
                masp, tensp, hinh, donvi, giaban, slton = result
                base_url = "http://localhost/LUAN_VAN/images/"
                image_url = base_url + hinh
                link = f"http://localhost/LUAN_VAN/index.php?act=chitiet&msp={masp}"
                # dispatcher.utter_message(
                #     text=f"Sản phẩm {tensp} còn {slton} ({donvi})."
                # )
                dispatcher.utter_message(
                    text=f"""Sản phẩm {tensp} còn {slton} ({donvi}).
                    {tensp} - {giaban} VND/{donvi}
                    🔗 <a href="{link}">Xem chi tiết sản phẩm</a>""",
                    image=image_url
                )

                
            else:
                dispatcher.utter_message(
                    text=f"❌ Hiện tại cửa hàng không có sản phẩm '{sanpham}' trong hệ thống."
                )

        except mysql.connector.Error as err:
            dispatcher.utter_message(text="⚠️ Lỗi truy vấn cơ sở dữ liệu.")
            print(f"MySQL Error: {err}")

        finally:
            if conn:
                conn.close()

        return []

#sản phẩm này phù hợp với thể trạng nào?  
import mysql.connector
from rasa_sdk import Action
from rasa_sdk.executor import CollectingDispatcher
from rasa_sdk.events import SlotSet

class ActionSpPhuHopTheTrangNao(Action):
    def name(self):
        return "action_sp_phuhop_thetrang_nao"

    def run(self, dispatcher: CollectingDispatcher, tracker, domain):
        food = tracker.get_slot("food")
        print(f"DEBUG: food = {food}")

        if not food:
            dispatcher.utter_message(text="❗ Bạn vui lòng cung cấp tên sản phẩm để tôi kiểm tra thể trạng phù hợp.")
            return []

        conn = None
        try:
            conn = mysql.connector.connect(
                host="localhost",
                user="root",
                password="",
                database="luanvan",
                charset="utf8"
            )
            cursor = conn.cursor()

            query = """
                SELECT tt.TTRANG_Ten, ph.PH_Mota
                FROM san_pham sp
                JOIN phuhop ph ON sp.SP_MaSP = ph.SP_MaSP
                JOIN the_trang tt ON ph.TTRANG_MA = tt.TTRANG_MA
                WHERE LOWER(sp.SP_TENSP) LIKE %s
            """
            cursor.execute(query, (f"%{food.lower()}%",))
            results = cursor.fetchall()

            if results:
                reply = f"✅ '{food}' phù hợp với các thể trạng sau:\n"
                for thetrang, mota in results:
                    reply += f"• {thetrang} — {mota}\n"
                dispatcher.utter_message(text=reply)
            else:
                dispatcher.utter_message(
                    text=f"❌ Hiện chưa có thông tin thể trạng phù hợp cho '{food}' trong hệ thống."
                )

        except mysql.connector.Error as err:
            dispatcher.utter_message(text="⚠️ Lỗi truy vấn cơ sở dữ liệu.")
            print(f"MySQL Error: {err}")

        finally:
            if conn:
                conn.close()

        return [SlotSet("food", None)]
