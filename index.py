import streamlit as st
import pandas as pd
import matplotlib.pyplot as plt
import numpy as np
from sklearn.linear_model import LinearRegression
import streamlit.components.v1 as com
import plotly.express as px


df=pd.read_csv("C:/xampp/htdocs/Stock_Project1/stok.csv")


st.set_page_config(
    page_title="My Streamlit App",
    page_icon="📊",
    layout="wide",
    initial_sidebar_state="auto",
)

st.markdown(
    """
    <style>
    .stApp {
        padding-left: 40px;
    }
    </style>
    """,
    unsafe_allow_html=True
)


container= st.container()
chart1,chart2 = container.columns(2)


with chart1:

    st.markdown("### Product-Stock Bar chart")
    st.bar_chart(data=df, x="Name",y="Stock",width=1000,height=500,use_container_width=True )

with chart2:

    st.markdown("### Pie Chart")
   

    fig = px.pie(df, values="Stock", names='Name',
                 height=300, width=400)
    fig.update_layout(margin=dict(l=20, r=20, t=30, b=0),)
    st.plotly_chart(fig, use_container_width=True)


container2= st.container()
chart3,chart4 = container2.columns(2)

with chart3:

    st.markdown("### Stock-Year Bar chart" )
    st.bar_chart(data=df, x="Year",y="Stock",width=500,height=500,use_container_width=True )

with chart4:

    st.markdown("### Line chart")
    st.line_chart(data=df, x="Year",y="Stock",width=1000,height=400,use_container_width=True )

