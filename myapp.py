import streamlit as st
import pandas as pd
import matplotlib.pyplot as plt
import numpy as np
from sklearn.linear_model import LinearRegression
import streamlit.components.v1 as com
import plotly.express as px

st.set_page_config(
    page_title="My Streamlit App",
    page_icon="📊",
    layout="wide",
    initial_sidebar_state="expanded",
)


df=pd.read_csv("C:/xampp/htdocs/Stock_Project1/stok.csv")

st.title("VEKTP AI Analysis")
st.dataframe(df)

st.sidebar.header('Choose product or year')
with st.sidebar:
    Year_filter = st.multiselect(label= 'Select Year',
                                options=df['Year'].unique(),
                                default=df['Year'].unique())

    Product_filter = st.multiselect(label='Select Product',
                            options=df['Name'].unique(),
                            default=df['Name'].unique())

df1 = df.query('Year == @Year_filter & Name == @Product_filter ')

st.markdown("### Stock-Year Bar chart" )
st.bar_chart(data=df1, x="Year",y="Stock",width=500,height=500,use_container_width=True )


container= st.container()
chart1,chart2 = container.columns(2)


with chart1:
    st.markdown("### Product-Stock Bar chart")

    st.bar_chart(data=df1, x="Name",y="Stock",width=500,height=500,use_container_width=True )

with chart2:

    st.markdown("### Pie Chart")
   

    fig = px.pie(df, values="Stock", names='Name',
                 height=300, width=200)
    fig.update_layout(margin=dict(l=20, r=20, t=30, b=0),)
    st.plotly_chart(fig, use_container_width=True)

st.markdown("### Line chart")
st.line_chart(data=df1, x="Year",y="Stock",width=1000,height=400,use_container_width=True )


st.title("Barchart of the next 4 years")

X = df[['Year']]  
y = df['Stock'] 

reg = LinearRegression()
reg.fit(X, y)


years = [2023, 2024, 2025, 2026]
X_future = pd.DataFrame({'Year': years})
y_pred = reg.predict(X_future)

st.bar_chart(pd.DataFrame({ 'Stock': y_pred}), x=years,y="Stock")


